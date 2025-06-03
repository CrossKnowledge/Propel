<?php
/**
 * Phing-specific autoloader for Propel namespaced classes
 * This autoloader is specifically designed to handle Phing's include_once() behavior
 */

spl_autoload_register(function ($class) {
    // Only handle CK\ namespaced classes
    if (strpos($class, 'CK\\') !== 0) {
        return false;
    }

    // Remove 'CK\' prefix to get the relative path
    $relativePath = substr($class, 3);

    // Convert namespace separators to directory separators
    $pathParts = explode('\\', $relativePath);

    // The last part is the class name (keep original case)
    $className = array_pop($pathParts);

    // Convert all directory parts to lowercase to match file structure
    $directoryParts = array_map('strtolower', $pathParts);

    // Construct the file path
    $filePath = implode('/', $directoryParts) . '/' . $className . '.php';

    // Try different base paths
    $basePaths = [
        __DIR__ . '/',                    // generator/lib/
        __DIR__ . '/../../runtime/lib/',  // runtime/lib/
        __DIR__ . '/../../../',           // root of propel package
    ];

    foreach ($basePaths as $basePath) {
        $fullPath = $basePath . $filePath;

        if (file_exists($fullPath)) {
            require_once $fullPath;
            return true;
        }
    }

    return false;
}, true, false); // Prepend to the autoload queue

// Also register a fallback for non-namespaced classes that map to namespaced ones
spl_autoload_register(function ($class) {
    // Don't handle if it's already namespaced
    if (strpos($class, '\\') !== false) {
        return false;
    }

    // Mapping of common legacy class names to their namespaced equivalents
    $classMap = [
        'PropelOMTask' => 'CK\\Generator\\Lib\\Task\\PropelOMTask',
        'PropelSQLTask' => 'CK\\Generator\\Lib\\Task\\PropelSQLTask',
        'PropelDataDumpTask' => 'CK\\Generator\\Lib\\Task\\PropelDataDumpTask',
        'PropelDataSQLTask' => 'CK\\Generator\\Lib\\Task\\PropelDataSQLTask',
        'PropelSchemaReverseTask' => 'CK\\Generator\\Lib\\Task\\PropelSchemaReverseTask',
        'PropelSQLDiffTask' => 'CK\\Generator\\Lib\\Task\\PropelSQLDiffTask',
        'PropelMigrationStatusTask' => 'CK\\Generator\\Lib\\Task\\PropelMigrationStatusTask',
        'PropelMigrationUpTask' => 'CK\\Generator\\Lib\\Task\\PropelMigrationUpTask',
        'PropelMigrationDownTask' => 'CK\\Generator\\Lib\\Task\\PropelMigrationDownTask',
        'PropelMigrationTask' => 'CK\\Generator\\Lib\\Task\\PropelMigrationTask',
        'PropelSQLExec' => 'CK\\Generator\\Lib\\Task\\PropelSQLExec',
        'PropelGraphvizTask' => 'CK\\Generator\\Lib\\Task\\PropelGraphvizTask',
        'PropelConvertConfTask' => 'CK\\Generator\\Lib\\Task\\PropelConvertConfTask',
        'PropelSqlBuildTask' => 'CK\\Generator\\Lib\\Task\\PropelSqlBuildTask',
    ];

    if (isset($classMap[$class])) {
        $namespacedClass = $classMap[$class];

        // Try to autoload the namespaced class first
        if (class_exists($namespacedClass, true)) {
            // Create alias from namespaced to legacy
            class_alias($namespacedClass, $class);
            return true;
        }
    }

    return false;
}, true, false);