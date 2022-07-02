<?php
session_start();
// user authentication, checking permissions in database
if(isset($permission) && !isset($_SESSION['user_id'])){
    $status_code = 401;
    $response = [
        'status' => 'Error',
        'message' => 'Unauthorized'
    ];

    apiReturn($status_code, $response);
    die();
} else {

$user_id = $_SESSION['user_id'];

$sql = "SELECT name,email,permissions FROM user WHERE id=$user_id";
    $result = $db->query($sql);

        $user = array();
        $row = $result->fetch_assoc();
        $user['name'] = $row['name'];
        $user['email'] = $row['email'];
        $user['permissions'] = userPerms($row['permissions']);
        $user_perms = $row['permissions'];

if ($permission > $user_perms) {
    $status_code = 403;
    $response = [
        'status' => 'Error',
        'message' => 'Forbidden'
    ];

    apiReturn($status_code, $response);
    die();
}   
}