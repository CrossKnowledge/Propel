<?php
// Bootstrap file that loads all necessary autoloaders

// Load composer autoloader first
require_once dirname(__FILE__) . '/../../vendor/autoload.php';

// Load the legacy class mapper
require_once dirname(__FILE__) . '/complete-autoloader.php';

// Set up custom error handler to intercept platform loading errors
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    // Check if this is a platform import error
    if (strpos($errstr, 'Error importing platform/') !== false) {
        // Extract the platform class name
        if (preg_match('/platform\/(\w+)\.php/', $errstr, $matches)) {
            $platformName = $matches[1];
            $fullClassName = "CK\\Generator\\Lib\\Platform\\$platformName";

            // Check if the class exists and create an alias
            if (class_exists($fullClassName)) {
                class_alias($fullClassName, $platformName);
                return true; // Suppress the error
            }
        }
    }

    // For other errors, use default error handling
    return false;
}, E_WARNING | E_USER_WARNING);

// Create a custom include path for platform files
$platformStubDir = sys_get_temp_dir() . '/propel-stubs-' . getmypid();
if (!is_dir($platformStubDir)) {
    mkdir($platformStubDir, 0777, true);
    mkdir($platformStubDir . '/platform', 0777, true);

    // Create stub files for common platforms
    $platforms = ['MysqlPlatform', 'SqlitePlatform', 'PgsqlPlatform', 'OraclePlatform', 'MssqlPlatform', 'DefaultPlatform'];
    foreach ($platforms as $platform) {
        $stubContent = "<?php\nif (!class_exists('$platform')) {\n    class_alias('CK\\\\Generator\\\\Lib\\\\Platform\\\\$platform', '$platform');\n}\n";
        file_put_contents($platformStubDir . "/platform/$platform.php", $stubContent);
    }

    // Add to include path
    set_include_path($platformStubDir . PATH_SEPARATOR . get_include_path());
}

// Register shutdown function to clean up
register_shutdown_function(function() use ($platformStubDir) {
    if (is_dir($platformStubDir)) {
        $files = glob($platformStubDir . '/platform/*.php');
        foreach ($files as $file) {
            @unlink($file);
        }
        @rmdir($platformStubDir . '/platform');
        @rmdir($platformStubDir);
    }
});