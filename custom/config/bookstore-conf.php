<?php

use CK\Runtime\Lib\Propel;

return [
    'datasources' => [
        'bookstore' => [
            'adapter' => 'mysql',
            'connection' => [
                'dsn' => 'mysql:host=mysql;dbname=bookstore',
                'user' => 'root',
                'password' => 'root',
                'settings' => [
                    'charset' => 'utf8mb4',
                    'queries' => ['SET NAMES utf8mb4']
                ],
                'classname' => CK\Runtime\Lib\Connection\PropelPDO::class,
                /*'options' => [
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]*/
            ]
        ],
        'default' => 'bookstore'
    ]
];
