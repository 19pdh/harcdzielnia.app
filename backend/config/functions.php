<?php
require('config.php');

header('X-Frame-Options: sameorigin');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');

$db = new mysqli($config->db->host, $config->db->user, $config->db->pass, $config->db->name);
$db->set_charset('utf8');

function apiReturn($status_code, $response){
    http_response_code($status_code);
    $api_response = [
        'code' => $status_code,
        'response' => $response
    ];
    echo json_encode($api_response);
}

function sanitizeStr($str){
    return htmlentities($str, ENT_QUOTES, "UTF-8");
}
?>