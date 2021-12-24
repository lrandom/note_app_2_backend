<?php
header("Content-Type: application/json; charset=utf-8");
require_once './DB.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db = new DB();
    $check = $db->deleteNote($id);
    if ($check) {
        http_response_code(200);
        echo json_encode(array('status' => 'success'));
    } else {
        http_response_code(500);
        echo json_encode(array('status' => 'error'));
    }
} else {
    echo 'Please enter a title and content';
}