<?php
require('config.php');

if($config['production'] !== true){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

header('X-Frame-Options: sameorigin');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');

$db = new mysqli($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['name']);
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