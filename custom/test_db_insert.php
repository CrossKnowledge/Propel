<?php

use CK\Runtime\Lib\Propel;

require_once __DIR__ . '/vendor/autoload.php';

echo "🧪 Inserting data via native PDO...\n";
try {
    $pdo = new \PDO('mysql:host=mysql;dbname=bookstore', 'root', 'root');
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    $pdo->exec("INSERT INTO book (title, isbn, price) VALUES ('Native PDO Book', '1234567890', 12.99)");
    $pdo->exec("INSERT INTO foo (longitude) VALUES (55.1234567)");

    $tables = ['book', 'foo'];
    foreach ($tables as $table) {
        echo "📦 Contents of $table (PDO):\n";
        $stmt = $pdo->query("SELECT * FROM `$table`");
        foreach ($stmt->fetchAll(\PDO::FETCH_ASSOC) as $row) {
            echo "  - " . json_encode($row) . "\n";
        }
    }
} catch (Exception $e) {
    echo "❌ PDO insert failed: " . $e->getMessage() . "\n";
}


echo "\n🧪 Inserting data via Propel...\n";
try {
    Propel::setConfiguration([
        'datasources' => [
            'default' => 'bookstore',
            'bookstore' => [
                'adapter' => 'mysql',
                'connection' => [
                    'dsn' => 'mysql:host=mysql;dbname=bookstore',
                    'user' => 'root',
                    'password' => 'root',
                ],
            ],
        ],
    ]);

    Propel::initialize();

    $con = Propel::getConnection('bookstore');

    $con->exec("INSERT INTO book (title, isbn, price) VALUES ('Propel Book', '9876543210', 19.99)");
    $con->exec("INSERT INTO foo (longitude) VALUES (66.7654321)");

    $tables = ['book', 'foo'];
    foreach ($tables as $table) {
        echo "📦 Contents of $table (Propel):\n";
        $stmt = $con->query("SELECT * FROM `$table`");
        foreach ($stmt->fetchAll(\PDO::FETCH_ASSOC) as $row) {
            echo "  - " . json_encode($row) . "\n";
        }
    }
} catch (Exception $e) {
    echo "❌ Propel insert failed: " . $e->getMessage() . "\n";
}
