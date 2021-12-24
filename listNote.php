<?php
header("Content-Type: application/json; charset=utf-8");
require_once './DB.php';
$db = new DB();

try {
    $list = $db->getNotes();
    http_response_code(200);//200 OK server trả về thành công
    echo json_encode($list);
} catch (Exception $exception) {
    http_response_code(500);//500 server không thể trả về dữ liệu
    echo json_encode(['message' => $exception->getMessage()]);
}