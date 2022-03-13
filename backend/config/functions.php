<?php
require('config.php');

function apiReturn($status_code, $response){
    http_response_code($status_code);
    $api_response = [
        'code' => $status_code,
        'response' => $response
    ];
    echo json_encode($api_response);
}
// database connection, global functions and CSRF tokens handling
?>