<?php
$req_method = "GET";
require '../../includes/header.php';

$sql = "SELECT id,name,image_url FROM items WHERE status=1";

$result = $db->query($sql);
if ($result->num_rows == 0) {
    $items = 0;
} else {
    $items = array();
    while ($row = $result->fetch_assoc()) {
        $items[$row['id']]['name'] = $row['name'];
        $items[$row['id']]['image_url'] = $row['image_url'];
    }
}

$status_code = 200;
$response = [
    'items' => $items
];

apiReturn($status_code, $response);
