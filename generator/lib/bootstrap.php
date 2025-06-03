<?php

/**
 * Bootstrap file for custom Propel 1 generator usage (namespaced).
 * Loads its own autoloader and registers legacy class aliases.
 */

// 1. Try to load the internal composer autoloader (self-contained logic)
$autoloadPaths = [
    // Running standalone inside the custom Propel repo
    __DIR__ . '/../../vendor/autoload.php',

    // Running as a dependency under vendor/ (e.g., in CKLS)
    __DIR__ . '/../../../../../vendor/autoload.php',
];

$autoloaded = false;

foreach ($autoloadPaths as $path) {
    if (file_exists($path)) {
        require_once $path;
        $autoloaded = true;
        break;
    }
}

if (!$autoloaded) {
    fwrite(STDERR, "[BOOTSTRAP ERROR] Could not find composer autoloader.\n");
    exit(1);
}

// 2. Register the file-based autoloader for Phing compatibility
spl_autoload_register(function ($class) {
    // Handle CK\* only
    if (strpos($class, 'CK\\') !== 0) {
        return false;
    }

    // Map namespace to base path
    $prefixMap = [
        'CK\\Generator\\Lib\\' => __DIR__, // Assuming __DIR__ is generator/lib
        'CK\\Runtime\\Lib\\'   => dirname(__DIR__, 2) . '/runtime/lib',
    ];

    foreach ($prefixMap as $prefix => $baseDir) {
        if (strpos($class, $prefix) === 0) {
            $relative = substr($class, strlen($prefix));
            $file = $baseDir . '/' . str_replace('\\', '/', $relative) . '.php';

            echo "\n[Autoload] $class → $file";

            if (file_exists($file)) {
                require_once $file;
                echo "\r\n $file: ✅ Loaded.\n";
                return true;
            } else {
                echo "\r\n $file: ❌ File not found.\n";
            }
        }
    }

    return false;
}, true, true);

// 3. Register lazy aliases for legacy Propel classes
$aliasesFile = __DIR__ . '/../../../propel_aliases.php';
if (file_exists($aliasesFile)) {
    require_once $aliasesFile;

    if (class_exists(\CK\PropelAliases::class)) {
        \CK\PropelAliases::register();
    } else {
        fwrite(STDERR, "[BOOTSTRAP WARNING] CK\\PropelAliases class not found.\n");
    }
}

// 4. Load the complete autoloader for comprehensive coverage
$completeAutoloaderFile = __DIR__ . '/complete-autoloader.php';
if (file_exists($completeAutoloaderFile)) {
    require_once $completeAutoloaderFile;
}

// More legacy class_alias() mappings can go here, or be handled inside PropelAliases