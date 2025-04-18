<?php
require_once '../config/config.php';
require_once 'functions.php';
function isCustomerTypeExists($type_customer, $exclude_id = null) {
    global $conn; // Assuming you have a database connection variable

    // Prepare the SQL query with case-insensitive comparison
    $sql = "SELECT COUNT(*) FROM customer_types WHERE LOWER(TRIM(type_customer)) = LOWER(TRIM(?))";
    $params = [$type_customer];

    // If an ID is provided to exclude (for update scenario), add that to the query
    if ($exclude_id !== null) {
        $sql .= " AND id_customer_type != ?";
        $params[] = $exclude_id;
    }

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat('s', count($params)), ...$params);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    // Return true if the customer type already exists
    return $count > 0;
}
header('Content-Type: application/json');

try {
    $action = $_GET['action'] ?? '';
    $response = ['success' => false, 'message' => ''];

    switch ($action) {
        case 'create':
            if (empty($_POST['type_customer'])) {
                throw new Exception('กรุณากรอกประเภทลูกค้า');
            }

            // Trim and convert to lowercase for case-insensitive comparison
            $type_customer = trim($_POST['type_customer']);

            // Check for duplicate customer type (case-insensitive)
            if (isCustomerTypeExists($type_customer)) {
                throw new Exception('ประเภทลูกค้านี้มีอยู่ในระบบแล้ว');
            }

            if (createCustomerType($type_customer)) {
                $response['success'] = true;
                $response['message'] = 'เพิ่มประเภทลูกค้าสำเร็จ';
            } else {
                throw new Exception('ไม่สามารถเพิ่มประเภทลูกค้าได้');
            }
            break;

        case 'update':
            if (empty($_POST['id_customer_type']) || empty($_POST['type_customer'])) {
                throw new Exception('กรุณากรอกข้อมูลให้ครบถ้วน');
            }
            
            // Trim and convert to lowercase for case-insensitive comparison
            $type_customer = trim($_POST['type_customer']);
            $id_customer_type = $_POST['id_customer_type'];

            // Check for duplicate customer type, excluding the current ID
            if (isCustomerTypeExists($type_customer, $id_customer_type)) {
                throw new Exception('ประเภทลูกค้านี้มีอยู่ในระบบแล้ว');
            }
            
            if (updateCustomerType($id_customer_type, $type_customer)) {
                $response['success'] = true;
                $response['message'] = 'อัปเดตประเภทลูกค้าสำเร็จ';
            } else {
                throw new Exception('ไม่สามารถอัปเดตประเภทลูกค้าได้');
            }
            break;

        case 'delete':
            if (empty($_GET['id_customer_type'])) {
                throw new Exception('ไม่พบ ID ประเภทลูกค้า');
            }

            // Check if customer type has associated customers before deletion
            $customerCount = getCustomerCountByType($_GET['id_customer_type']);
            if ($customerCount > 0) {
                throw new Exception("ไม่สามารถลบประเภทลูกค้านี้ได้ เนื่องจากมีลูกค้า {$customerCount} รายการที่ใช้ประเภทนี้อยู่");
            }

            if (deleteCustomerType($_GET['id_customer_type'])) {
                $response['success'] = true;
                $response['message'] = 'ลบประเภทลูกค้าสำเร็จ';
            } else {
                throw new Exception('ไม่สามารถลบประเภทลูกค้าได้');
            }
            break;

        default:
            throw new Exception('Invalid action');
    }

} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = $e->getMessage();
}

echo json_encode($response);