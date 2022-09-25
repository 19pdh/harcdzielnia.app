<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once '../config/functions.php';

use Cloudinary\Configuration\Configuration;

Configuration::instance([
    'cloud' => [
        'cloud_name' => $config['cloudinary']['cloud_name'],
        'api_key' => $config['cloudinary']['api_key'],
        'api_secret' => $config['cloudinary']['api_secret'],
    ],
    'url' => [
        'secure' => true
    ]
]);
