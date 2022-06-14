<?php
$config = [
    'production' => false,

    'site' => [
        'base_url' => 'http://localhost/api',
        'salt' => 'any_random_string'
    ],

    'db' => [
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'name' => 'harcdzielnia'
    ],

    'cloudinary' => [
        'cloud_name' => '', // Cloudinary cloud name
        'api_key' => '', // Cloudinary API key
        'api_secret' => '', // Cloudinary API secret
        'folder' => 'harcdzielnia/' // Cloudinary selected folder (end with a slash)

        // More info at https://cloudinary.com/documentation/php_integration#setting_parameters_globally
    ]
];
