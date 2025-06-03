<?php
/**
 * Debug script to test autoloading functionality
 */

echo "=== Propel Autoloader Debug Script ===\n";

// Load bootstrap
require_once __DIR__ . '/bootstrap.php';

// Test classes that Phing needs
$testClasses = [
    'CK\\Generator\\Lib\\Task\\PropelOMTask',
    'CK\\Generator\\Lib\\Task\\PropelSQLTask',
    'CK\\Generator\\Lib\\Task\\PropelDataDumpTask',
    'CK\\Generator\\Lib\\Model\\Database',
    'CK\\Generator\\Lib\\Platform\\MysqlPlatform',
];

echo "\nTesting autoloading of key classes:\n";

foreach ($testClasses as $class) {
    echo "Testing class: $class\n";

    if (class_exists($class)) {
        echo "  ✓ Class loaded successfully\n";

        // Try to create an alias
        $shortName = substr(strrchr($class, '\\'), 1);
        if (!class_exists($shortName)) {
            class_alias($class, $shortName);
            echo "  ✓ Alias '$shortName' created\n";
        } else {
            echo "  ℹ Alias '$shortName' already exists\n";
        }
    } else {
        echo "  ✗ Failed to load class\n";

        // Show expected file path
        $relativePath = substr($class, 3); // Remove CK\
        $pathParts = explode('\\', $relativePath);
        $className = array_pop($pathParts);
        $directoryParts = array_map('strtolower', $pathParts);
        $expectedPath = __DIR__ . '/' . implode('/', $directoryParts) . '/' . $className . '.php';

        echo "  Expected file: $expectedPath\n";
        echo "  File exists: " . (file_exists($expectedPath) ? 'YES' : 'NO') . "\n";
    }
    echo "\n";
}

// Show registered autoloaders
echo "Registered autoloaders:\n";
$autoloaders = spl_autoload_functions();
foreach ($autoloaders as $index => $loader) {
    if (is_array($loader)) {
        echo "  $index: " . (is_object($loader[0]) ? get_class($loader[0]) : $loader[0]) . "::" . $loader[1] . "\n";
    } else if (is_object($loader)) {
        echo "  $index: " . get_class($loader) . "\n";
    } else {
        echo "  $index: $loader\n";
    }
}

echo "\n=== End Debug ===\n";