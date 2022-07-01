<?php
$req_method = "GET";
$permission = 1;
require '../../includes/header.php';

$sql = "SELECT name,description,image_url,order_type,contact_info,email,timestamp FROM items WHERE AND id=?";
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows == 0) {
    $items = 0;
} else {
    $item = array();
    $row = $result->fetch_assoc();
    $item['name'] = $row['name'];
    $item['description'] = $row['description'];
    $item['image_url'] = $row['image_url'];
    $item['order_type'] = $row['order_type'];
    $item['contact_info'] = $row['contact_info'];
    $item['email'] = $row['email'];
    $item['timestamp'] = date('d.m.y H:i', $row['contact_info']);
}

$status_code = 200;
$response = [
    'item' => $item
];

apiReturn($status_code, $response);
