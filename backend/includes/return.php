<?php
http_response_code($status_code);
$api_response = [
    'code' => $status_code,
    'response' => $response
];

echo json_encode($api_response);
?>