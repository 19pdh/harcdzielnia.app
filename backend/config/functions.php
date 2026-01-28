<?php
require 'config.php';

if ($config['production'] !== true) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

header('X-Frame-Options: sameorigin');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');

date_default_timezone_set('Europe/Warsaw');
$timestamp = time();
$userAgent = sanitizeStr($_SERVER['HTTP_USER_AGENT']);

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

function randomStr($length){
   return bin2hex(random_bytes($length));
}

function getCsrf(){
    if (isset($_SESSION['csrf'])) {
        $token_age = $timestamp - $_SESSION['csrf_time'];
        if ($token_age <= $config['site']['csrf_time']){  
            return $_SESSION['csrf'];
        } else {
            $_SESSION['csrf'] = sha1(randomStr().$userAgent);
            $_SESSION['csrf_time'] = $timestamp;
            return $_SESSION['csrf'];
        }
    } else {
        $_SESSION['csrf'] = sha1(randomStr().$userAgent);
        $_SESSION['csrf_time'] = $timestamp;
        return $_SESSION['csrf'];
    }
    setcookie("csrf", $_SESSION['csrf'], $config['site']['csrf_time'], '/', $config['site']['domain'], true, false, 'Lax');
}

function verifyCsrf($token){
    if (isset($_SESSION['csrf'])) {
        $token_age = $timestamp - $_SESSION['csrf_time'];
        if ($token_age <= $config['site']['csrf_time']){ 
            if ($token == $_SESSION['csrf']) {
                    unset($_SESSION['csrf']);
                    unset($_SESSION['csrf_time']);
                    return true;
                } else {
                unset($_SESSION['csrf']);
                unset($_SESSION['csrf_time']);
                return false;
                }
            } else {
                unset($_SESSION['csrf']);
                unset($_SESSION['csrf_time']);
                return false;
            }
        } else {
            return false;
        }
    }
