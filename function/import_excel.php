<?php
require_once '../config/config.php';
require_once 'functions.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// ตรวจสอบการอัปโหลดไฟล์
if (!isset($_FILES['excelFile']) || $_FILES['excelFile']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'message' => 'ไม่มีไฟล์ถูกอัปโหลดหรือเกิดข้อผิดพลาด']);
    exit;
}

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if (!$conn) {
    echo json_encode(['success' => false, 'message' => 'ไม่สามารถเชื่อมต่อฐานข้อมูลได้']);
    exit;
}

$file = $_FILES['excelFile']['tmp_name'];

try {
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    // ตรวจสอบคอลัมน์
    $header = array_map(fn($col) => strtolower(trim(preg_replace('/\s+/', ' ', $col))), array_shift($rows));
    $expectedHeader = ['name', 'type', 'phone', 'status', 'address', 'tambon', 'amphure'];

    if (count($header) !== count($expectedHeader) || $header !== $expectedHeader) {
        echo json_encode(['success' => false, 'message' => 'โครงสร้างไฟล์ Excel ไม่ถูกต้อง']);
        exit;
    }
    $conn->begin_transaction();

    // ดึงข้อมูลที่จำเป็นเพื่อลดจำนวน query
    $customerTypes = $conn->query("SELECT id_customer_type, type_customer FROM customer_types")->fetch_all(MYSQLI_ASSOC);
    $amphures = $conn->query("SELECT id_amphures, name_amphures FROM amphures")->fetch_all(MYSQLI_ASSOC);
    $tambons = $conn->query("SELECT id_tambons, name_tambons, id_amphures FROM tambons")->fetch_all(MYSQLI_ASSOC);

    $customerTypeMap = array_column($customerTypes, 'id_customer_type', 'type_customer');
    $amphureMap = array_column($amphures, 'id_amphures', 'name_amphures');
    $tambonMap = [];
    foreach ($tambons as $tambon) {
        $tambonMap[$tambon['name_tambons']][$tambon['id_amphures']] = $tambon['id_tambons'];
    }

    // ตรวจสอบชื่อลูกค้าซ้ำในฐานข้อมูล
    $existingCustomers = $conn->query("SELECT name_customer FROM customers")->fetch_all(MYSQLI_ASSOC);
    $existingNames = array_column($existingCustomers, 'name_customer');

    foreach ($rows as $row) {
        list($name, $type, $phone, $status, $address, $tambon, $amphure) = array_map('trim', $row);
 
        // ตรวจสอบค่าที่จำเป็น
        if (empty($name) || empty($type) || empty($status) || empty($tambon) || empty($amphure)) {
            $conn->rollback();
            echo json_encode(['success' => false, 'message' => 'ข้อมูลที่จำเป็นหายไปในไฟล์ Excel']);
            exit;
        }

        // ตรวจสอบชื่อซ้ำในฐานข้อมูล
        if (in_array($name, $existingNames)) {
            $conn->rollback();
            echo json_encode([
                'success' => false,
                'message' => 'ชื่อลูกค้าซ้ำ ไม่สามารถนำเข้าข้อมูลได้',
                'duplicate' => true,
                'name' => $name
            ]);
            exit;
        }

        // ตรวจสอบประเภทลูกค้า
        if (!isset($customerTypeMap[$type])) {
            $conn->rollback();
            echo json_encode(['success' => false, 'message' => 'ประเภทลูกค้าไม่ถูกต้อง']);
            exit;
        }
        $id_customer_type = $customerTypeMap[$type];

        // ตรวจสอบอำเภอ
        if (!isset($amphureMap[$amphure])) {
            $conn->rollback();
            echo json_encode(['success' => false, 'message' => 'อำเภอไม่ถูกต้อง']);
            exit;
        }
        $id_amphures = $amphureMap[$amphure];

        // ตรวจสอบตำบล
        if (!isset($tambonMap[$tambon][$id_amphures])) {
            $conn->rollback();
            echo json_encode(['success' => false, 'message' => 'ตำบลไม่ถูกต้อง']);
            exit;
        }
        $id_tambons = $tambonMap[$tambon][$id_amphures];

        // ตรวจสอบเบอร์โทรศัพท์
        if (!empty($phone) && !preg_match('/^(\d{3}-\d{3}-\d{4}|\d{3}-\d{7}|\d{9,10})(\s*(ต่อ|ext\.?)?\s*[a-zA-Zก-๙0-9.]+)?$/u', $phone)) {
            $conn->rollback();
            echo json_encode(['success' => false, 'message' => 'รูปแบบเบอร์โทรศัพท์ไม่ถูกต้อง']);
            exit;
        }
        

        // ตรวจสอบสถานะ
        if (!in_array($status, ['ใช้งาน', 'ไม่ได้ใช้งาน'])) {
            $conn->rollback();
            echo json_encode(['success' => false, 'message' => 'ค่าสถานะต้องเป็น "ใช้งาน" หรือ "ไม่ได้ใช้งาน"']);
            exit;
        }

        // เพิ่มที่อยู่
        $stmt = $conn->prepare("INSERT INTO address (info_address, id_tambons, id_amphures) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $address, $id_tambons, $id_amphures);
        if (!$stmt->execute()) {
            $conn->rollback();
            echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการเพิ่มข้อมูลที่อยู่']);
            exit;
        }
        $id_address = $conn->insert_id;

        // เพิ่มลูกค้า
        $stmt = $conn->prepare("INSERT INTO customers (name_customer, phone_customer, status_customer, id_address, id_customer_type, create_at, update_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())");
        $stmt->bind_param("sssii", $name, $phone, $status, $id_address, $id_customer_type);
        if (!$stmt->execute()) {
            $conn->rollback();
            echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการเพิ่มข้อมูลลูกค้า']);
            exit;
        }
    }

    $conn->commit();
    echo json_encode(['success' => true, 'message' => 'นำเข้าข้อมูลสำเร็จ']);

} catch (Exception $e) {
    if (!$conn->autocommit(true)) { 
        $conn->rollback();
    }    
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>