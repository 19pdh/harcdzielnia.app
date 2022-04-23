<?php
require('config.php');

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

function escapeStr($str){
    global $db;
    return $db->real_escape_string($str);
}
?>