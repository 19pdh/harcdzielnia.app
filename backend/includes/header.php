<?php
header('Content-type: application/json;charset=utf-8');
require('../config/functions.php');
require('authentication.php');

$id = sanitizeStr(escapeStr($_GET['id']));
?>