<?php

try {
    $c = new PDO("mysql:host=mysql;dbname=test", "root", "root");
    echo 'Connection successful!' . PHP_EOL;
} catch (Exception $e) {
    echo 'Failed to connect to MySql: ', $e->getMessage() . PHP_EOL;
}
