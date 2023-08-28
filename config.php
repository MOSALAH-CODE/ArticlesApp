<?php

return [
    'database' => [
        'host' => 'localhost',
        'port' => 3306,
        'dbname' => 'noteapp',
        'username' => 'admin',
        'password' => 'admin',
        'charset' => 'utf8mb4'
    ],
    'remember' => [
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ],
    'sessions' => [
        'session_name' => 'user',
        'token_name' => 'token'
    ]
];