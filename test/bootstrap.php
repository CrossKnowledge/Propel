<?php
/**
 * Bootstrap file for namespaced Propel tests
 * This file sets up autoloading and initializes Propel for testing
 */

// Set up include paths and Composer autoloader
if (file_exists($file = dirname(__FILE__) . '/../vendor/autoload.php')) {
    set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__) . '/../vendor/phing/phing/classes');
    require_once $file;
}

// Define test base directory constant
if (!defined('TESTS_BASE_DIR')) {
    define('TESTS_BASE_DIR', dirname(__FILE__));
}

// Manual autoloader for CK\Runtime\Lib namespace during migration
spl_autoload_register(function ($class) {
    // Handle CK\Runtime\Lib namespace
    if (strpos($class, 'CK\\Runtime\\Lib\\') === 0) {
        $relativePath = str_replace(['CK\\Runtime\\Lib\\', '\\'], ['', '/'], $class);
        $filePath = dirname(__DIR__) . '/runtime/lib/' . $relativePath . '.php';

        if (file_exists($filePath)) {
            require_once $filePath;
            return true;
        }
    }

    // Handle generated model classes (bookstore package)
    if (strpos($class, 'bookstore') === 0 ||
        in_array($class, ['BookPeer', 'Book', 'AuthorPeer', 'Author', 'PublisherPeer', 'Publisher'])) {

        // Look in fixtures build directory
        $buildDir = TESTS_BASE_DIR . '/fixtures/bookstore/build/classes/bookstore/';
        $classFile = $buildDir . str_replace('\\', '/', $class) . '.php';

        if (file_exists($classFile)) {
            require_once $classFile;
            return true;
        }

        // Fallback: look for Peer classes
        if (strpos($class, 'Peer') !== false) {
            $peerFile = $buildDir . $class . '.php';
            if (file_exists($peerFile)) {
                require_once $peerFile;
                return true;
            }
        }
    }

    return false;
});

// Initialize Propel with the test configuration
try {
    // Use the namespaced Propel class
    $propelClass = 'CK\\Runtime\\Lib\\Propel';

    if (class_exists($propelClass)) {
        $configFile = TESTS_BASE_DIR . '/fixtures/bookstore/build/conf/bookstore-conf.php';
        if (file_exists($configFile)) {
            $propelClass::init($configFile);
        } else {
            // Fallback to runtime-conf.xml if PHP config doesn't exist
            $xmlConfigFile = TESTS_BASE_DIR . '/fixtures/bookstore/runtime-conf.xml';
            if (file_exists($xmlConfigFile)) {
                // Convert XML config to array format that Propel expects
                $config = include_once TESTS_BASE_DIR . '/tools/helpers/config/PropelXMLConfigConverter.php';
                $propelClass::setConfiguration($config);
                $propelClass::initialize();
            }
        }
    }
} catch (Exception $e) {
    // If initialization fails, continue - tests will handle it
    error_log("Propel initialization failed: " . $e->getMessage());
}

