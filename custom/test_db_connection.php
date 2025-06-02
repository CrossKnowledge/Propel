<?php
use CK\Runtime\Lib\Propel;

require_once __DIR__ . '/vendor/autoload.php';

echo "🧪 Testing native PDO connection...\n";
try {
    $pdo = new \PDO('mysql:host=mysql;dbname=bookstore', 'root', 'root');
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $tables = $pdo->query('SHOW TABLES')->fetchAll(\PDO::FETCH_COLUMN);
    echo "✅ PDO connected. Tables in bookstore:\n";
    foreach ($tables as $table) {
        echo "- $table\n";
        $desc = $pdo->query("DESCRIBE `$table`")->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($desc as $col) {
            echo "  ▸ {$col['Field']} ({$col['Type']})\n";
        }
    }
} catch (Exception $e) {
    echo "❌ PDO connection failed: " . $e->getMessage() . "\n";
}


echo "\n🧪 Testing Propel connection...\n";
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
    $tables = $con->query('SHOW TABLES')->fetchAll(\PDO::FETCH_COLUMN);
    echo "✅ Propel connected. Tables in bookstore:\n";
    foreach ($tables as $table) {
        echo "- $table\n";
        $desc = $con->query("DESCRIBE `$table`")->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($desc as $col) {
            echo "  ▸ {$col['Field']} ({$col['Type']})\n";
        }
    }
} catch (Exception $e) {
    echo "❌ Propel connection failed: " . $e->getMessage() . "\n";
}
