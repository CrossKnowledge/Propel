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
    $prefixMap = [
        'CK\\Generator\\Lib\\' => __DIR__,
        'CK\\Runtime\\Lib\\'   => dirname(__DIR__, 2) . '/runtime/lib',
        'CrossKnowledge\\'     => '/data/ckls/classes', // Full path retained
    ];

    foreach ($prefixMap as $prefix => $baseDir) {
        if (strpos($class, $prefix) === 0) {
            if ($prefix === 'CrossKnowledge\\') {
                // Keep full path for CrossKnowledge
                $relativePath = str_replace('\\', '/', $class);
            } else {
                // Strip the prefix for CK\* namespaces
                $relativePath = str_replace('\\', '/', substr($class, strlen($prefix)));
            }

            $file = rtrim($baseDir, '/') . '/' . $relativePath . '.php';

            echo "\n[Autoload] $class → $file";

            if (file_exists($file)) {
                require_once $file;
                echo "\n$file: ✅ Loaded.\n";
                return true;
            } else {
                echo "\n$file: ❌ File not found.\n";
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