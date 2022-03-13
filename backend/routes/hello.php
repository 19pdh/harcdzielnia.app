<?php
require('../includes/header.php');

$status_code = 200;
$response = [
    'message' => 'Hello world'
];

apiReturn($status_code, $response);
?>