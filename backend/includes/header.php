<?php
header('Content-type: application/json;charset=utf-8');
require __DIR__ . '/../config/functions.php';

if ($req_method !== $_SERVER["REQUEST_METHOD"]) {
    $status_code = 400;
    $response = [
        'status' => 'Error',
        'message' => 'Bad request'
    ];

    apiReturn($status_code, $response);
    die();
}

require 'authentication.php';

if (!empty($_GET['id'])) {
    $id = sanitizeStr($_GET['id']);
}

if (!empty($_GET['token'])) {
    $id = sanitizeStr($_GET['token']);
}
