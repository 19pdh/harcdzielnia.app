<?php
session_start();
// user authentication, checking permissions in database
if ($permission !== $userPerms) {
    $status_code = 403;
    $response = [
        'status' => 'Error',
        'message' => 'Forbidden'
    ];

    apiReturn($status_code, $response);
    die();
}
