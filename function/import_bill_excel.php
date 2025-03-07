<?php
// import_bill_service_excel.php

require_once '../config/config.php';
require_once 'functions.php';

// ตรวจสอบว่ามีไฟล์ถูกอัปโหลดหรือไม่ (สำหรับการนำเข้าข้อมูลจากไฟล์ Excel)
if (!isset($_FILES['excelFile']) || $_FILES['excelFile']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'message' => 'ไม่มีไฟล์ถูกอัปโหลดหรือเกิดข้อผิดพลาดในการอัปโหลดไฟล์']);
    exit;
}

// เรียกใช้ไลบรารี PhpSpreadsheet
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$file = $_FILES['excelFile']['tmp_name'];
try {
    // อ่านไฟล์ Excel
    $spreadsheet = IOFactory::load($file);
    
    // ตรวจสอบ customer_id จาก POST request
    if (!isset($_POST['id_customer']) || empty($_POST['id_customer'])) {
        echo json_encode(['success' => false, 'message' => 'ไม่พบรหัสลูกค้า']);
        exit;
    }
    
    $id_customer = intval($_POST['id_customer']);
    
    // ตรวจสอบว่าลูกค้ามีอยู่จริงหรือไม่
    $checkCustomer = "SELECT id_customer FROM customers WHERE id_customer = ?";
    $stmt = $conn->prepare($checkCustomer);
    $stmt->bind_param("i", $id_customer);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'ไม่พบข้อมูลลูกค้า']);
        exit;
    }
    
    // นับจำนวนบิลและบริการที่นำเข้าสำเร็จ
    $billSuccessCount = 0;
    $billUpdatedCount = 0;
    $serviceSuccessCount = 0;
    $serviceUpdatedCount = 0;
    $errors = [];
    
    // เริ่มทำ transaction
    $conn->begin_transaction();
    
    try {
        // อ่าน Sheet ของ Bills
        $billSheet = $spreadsheet->getSheetByName('Bills');
        if ($billSheet) {
            $billRows = $billSheet->toArray();
            
            // ตรวจสอบหัวคอลัมน์สำหรับ Bills
            $billHeader = array_shift($billRows);
            $expectedBillHeader = ['Number', 'Type', 'Status', 'Start', 'Contact(Month)'];
            
            if ($billHeader !== $expectedBillHeader) {
                throw new Exception('รูปแบบ Sheet "Bills" ไม่ถูกต้อง');
            }
            
            $validTypes = ['CIP+', 'Special Bill', 'Nt1'];
            $validStatuses = ['ใช้งาน', 'ยกเลิกใช้งาน'];
            
            // Process Bills
            $billMap = []; // เก็บความสัมพันธ์ระหว่าง number_bill และ id_bill เพื่อใช้สำหรับ services
            
            foreach ($billRows as $rowIndex => $row) {
                // ข้ามแถวที่ว่าง
                if (empty($row[0])) {
                    continue;
                }
                
                $number_bill = trim($row[0]);
                $type_bill = trim($row[1]);
                $status_bill = trim($row[2]);
                $create_at = trim($row[3]);
                $date_count = intval(trim($row[4]));
                
                // ตรวจสอบค่า type และ status
                if (!in_array($type_bill, $validTypes)) {
                    $errors[] = "ประเภทบิล $type_bill ไม่ถูกต้อง";
                    continue;
                }
                if (!in_array($status_bill, $validStatuses)) {
                    $errors[] = "สถานะบิล $status_bill ไม่ถูกต้อง";
                    continue;
                }
                
                // ตรวจสอบรูปแบบวันที่
                if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $create_at)) {
                    $create_at = date('Y-m-d', strtotime($create_at));
                }
                
                // คำนวณวันที่สิ้นสุดสัญญาจากเดือน
                $end_date = date('Y-m-d', strtotime($create_at . " + $date_count months"));
                
                // ตรวจสอบว่าบิลซ้ำหรือไม่
                $checkDuplicate = "SELECT id_bill FROM bill_customer WHERE number_bill = ? AND id_customer = ?";
                $stmt = $conn->prepare($checkDuplicate);
                $stmt->bind_param("si", $number_bill, $id_customer);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    // หากมีอยู่แล้ว ให้อัปเดตข้อมูล
                    $bill_row = $result->fetch_assoc();
                    $id_bill = $bill_row['id_bill'];
                    
                    $updateBill = "UPDATE bill_customer SET type_bill = ?, status_bill = ?, create_at = ?, update_at = NOW(), date_count = ?, end_date = ? WHERE number_bill = ? AND id_customer = ?";
                    $stmt = $conn->prepare($updateBill);
                    $stmt->bind_param("ssssssi", $type_bill, $status_bill, $create_at, $date_count, $end_date, $number_bill, $id_customer);
                    if ($stmt->execute()) {
                        $billUpdatedCount++;
                    }
                } else {
                    // เพิ่มข้อมูลบิลใหม่
                    $insertBill = "INSERT INTO bill_customer (id_customer, number_bill, type_bill, status_bill, create_at, update_at, date_count, end_date) 
                                VALUES (?, ?, ?, ?, ?, NOW(), ?, ?)";
                    $stmt = $conn->prepare($insertBill);
                    $stmt->bind_param("issssss", $id_customer, $number_bill, $type_bill, $status_bill, $create_at, $date_count, $end_date);
                    if ($stmt->execute()) {
                        $id_bill = $conn->insert_id;
                        $billSuccessCount++;
                    }
                }
                
                // เก็บข้อมูลสำหรับใช้ในการเชื่อมโยงกับบริการ
                $billMap[$number_bill] = $id_bill;
            }
            
            // อ่าน Sheet ของ Services (ถ้ามี)
            $serviceSheet = $spreadsheet->getSheetByName('Services');
            if ($serviceSheet) {
                $serviceRows = $serviceSheet->toArray();
                
                // ตรวจสอบหัวคอลัมน์สำหรับ Services
                $serviceHeader = array_shift($serviceRows);
                $expectedServiceHeader = ['Number', 'Code', 'Type', 'Gadget', 'Status', 'Start'];
                
                if ($serviceHeader !== $expectedServiceHeader) {
                    throw new Exception('รูปแบบ Sheet "Services" ไม่ถูกต้อง');
                }
                
                $validServiceTypes = ['Fttx', 'Fttx+ICT solution', 'Fttx 2+ICT solution', 'SI service', 'วงจเช่า', 'IP phone', 'Smart City', 'WiFi', 'อื่นๆ'];
                $validGadgetTypes = ['เช่า', 'ขาย', 'เช่าและขาย'];
                $validServiceStatuses = ['ใช้งาน', 'ยกเลิก'];
                
                foreach ($serviceRows as $rowIndex => $row) {
                    // ข้ามแถวที่ว่าง
                    if (empty($row[0])) {
                        continue;
                    }

                    $bill_number = trim($row[0]);
                    $code_service = trim($row[1]);
                    $type_service = trim($row[2]);
                    $type_gadget = trim($row[3]);
                    $status_service = trim($row[4]);
                    $create_at = trim($row[5]);
                    
                    // ตรวจสอบค่า types และ status
                    if (!in_array($type_service, $validServiceTypes)) {
                        $errors[] = "ประเภทบริการ $type_service ไม่ถูกต้อง";
                        continue;
                    }
                    if (!in_array($type_gadget, $validGadgetTypes)) {
                        $errors[] = "ประเภทอุปกรณ์ $type_gadget ไม่ถูกต้อง";
                        continue;
                    }
                    if (!in_array($status_service, $validServiceStatuses)) {
                        $errors[] = "สถานะบริการ $status_service ไม่ถูกต้อง";
                        continue;
                    }
                    
                    // ตรวจสอบว่ามีหมายเลขบิลใน billMap หรือไม่
                    if (!isset($billMap[$bill_number])) {
                        $errors[] = "ไม่พบหมายเลขบิล $bill_number สำหรับบริการ $code_service";
                        continue;
                    }
                    
                    $id_bill = $billMap[$bill_number];
                    
                    // ตรวจสอบรูปแบบวันที่
                    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $create_at)) {
                        $create_at = date('Y-m-d', strtotime($create_at));
                    }
                    
                    // ตรวจสอบว่าบริการซ้ำหรือไม่
                    $checkDuplicate = "SELECT id_service FROM service_customer WHERE code_service = ? AND id_bill = ?";
                    $stmt = $conn->prepare($checkDuplicate);
                    $stmt->bind_param("si", $code_service, $id_bill);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {
                        // หากมีอยู่แล้ว ให้อัปเดตข้อมูล
                        $updateService = "UPDATE service_customer SET type_service = ?, type_gadget = ?, status_service = ?, create_at = ?, update_at = NOW() WHERE code_service = ? AND id_bill = ?";
                        $stmt = $conn->prepare($updateService);
                        $stmt->bind_param("sssssi", $type_service, $type_gadget, $status_service, $create_at, $code_service, $id_bill);
                        if ($stmt->execute()) {
                            $serviceUpdatedCount++;
                        }
                    } else {
                        // เพิ่มข้อมูลบริการใหม่
                        $insertService = "INSERT INTO service_customer (code_service, type_service, type_gadget, status_service, id_bill, create_at, update_at) 
                                       VALUES (?, ?, ?, ?, ?, ?, NOW())";
                        $stmt = $conn->prepare($insertService);
                        $stmt->bind_param("ssssis", $code_service, $type_service, $type_gadget, $status_service, $id_bill, $create_at);
                        if ($stmt->execute()) {
                            $serviceSuccessCount++;
                        }
                    }
                }
            }
        } else {
            throw new Exception('ไม่พบ Sheet "Bills" ในไฟล์ Excel');
        }
        
        // หากไม่มีข้อผิดพลาด ให้ commit transaction
        $conn->commit();
        
        $message = "นำเข้าข้อมูลบิลสำเร็จ $billSuccessCount รายการ, อัปเดตข้อมูลบิลสำเร็จ $billUpdatedCount รายการ";
        if ($serviceSuccessCount > 0 || $serviceUpdatedCount > 0) {
            $message .= ", นำเข้าข้อมูลบริการสำเร็จ $serviceSuccessCount รายการ, อัปเดตข้อมูลบริการสำเร็จ $serviceUpdatedCount รายการ";
        }
        
        echo json_encode([
            'success' => true, 
            'message' => $message,
            'errors' => $errors
        ]);
    } catch (Exception $e) {
        // กรณีเกิด exception ให้ rollback transaction
        $conn->rollback();
        echo json_encode([
            'success' => false, 
            'message' => "เกิดข้อผิดพลาดในการนำเข้าข้อมูล: " . $e->getMessage(),
            'errors' => $errors
        ]);
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการอ่านไฟล์ Excel: ' . $e->getMessage()]);
}
?>