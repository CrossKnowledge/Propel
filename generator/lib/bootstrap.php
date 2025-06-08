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
spl_autoload_register(function ($originalClass) {
    $prefixMap = [
        'CK\\Generator\\Lib\\' => __DIR__,
        'CK\\Runtime\\Lib\\'   => dirname(__DIR__, 2) . '/runtime/lib',
        'CrossKnowledge\\'     => '/data/ckls/classes',
    ];

    // Save original for matching, normalize for case-insensitive matching
    $lowerClass = strtolower($originalClass);

    foreach ($prefixMap as $prefix => $baseDir) {
        $lowerPrefix = strtolower($prefix);

        if (strpos($lowerClass, $lowerPrefix) === 0) {
            // Determine if we strip the prefix (for CK) or keep it (CrossKnowledge)
            if ($prefix === 'CrossKnowledge\\') {
                // Preserve full namespace path with original casing
                $relativeClass = str_replace('\\', '/', $originalClass);
            } else {
                // Strip prefix, split, lowercase folders, keep class filename case
                $suffix = substr($originalClass, strlen($prefix));
                $parts = explode('\\', $suffix);
                $classFile = array_pop($parts); // Keep filename case
                $folders = array_map('strtolower', $parts); // lowercase folders only
                $relativeClass = implode('/', $folders) . '/' . $classFile;
            }

            $file = rtrim($baseDir, '/') . '/' . $relativeClass . '.php';

            if (file_exists($file)) {
                require_once $file;
                echo "\n[Autoload] ✅ $originalClass → $file\n";
                return true;
            } else {
                echo "\n[Autoload] ❌ $originalClass → $file (Not found)\n";
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