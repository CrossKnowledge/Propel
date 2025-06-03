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
    // Only handle namespaced classes prefixed with CK\
    if (strpos($class, 'CK\\') !== 0) {
        return false;
    }

    // Map CK\Generator\Lib\Platform\MysqlPlatform
    // to lib/platform/MysqlPlatform.php
    $relative = substr($class, 3); // Remove "CK\"
    $parts = explode('\\', $relative);

    // Remove the fixed "Generator\Lib" prefix from namespace
    if ($parts[0] === 'Generator' && $parts[1] === 'Lib') {
        array_shift($parts); // remove 'Generator'
        array_shift($parts); // remove 'Lib'
    }

    $filename = array_pop($parts);
    $folders = array_map('strtolower', $parts);

    $path = __DIR__ . '/' . implode('/', $folders) . '/' . $filename . '.php';

    echo "\nAutoloading class $class → $path";

    if (file_exists($path)) {
        require_once $path;
        echo " ✅ Loaded.\n";
        return true;
    }

    echo " ❌ File not found.\n";
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

// 5. Optional: define dummy class equivalents for any old include_once('X.php')-based file

// Example legacy placeholder for old platform/Platform.php
if (!class_exists('Platform') && class_exists(\CK\Generator\Lib\Platform\Platform::class)) {
    class_alias(\CK\Generator\Lib\Platform\Platform::class, 'Platform');
}

// More legacy class_alias() mappings can go here, or be handled inside PropelAliases