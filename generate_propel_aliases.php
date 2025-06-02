<?php
/**
 * Propel Class Alias Generator, needed to avoid changing the code-base of CKLS
 * @author : Abou-Bakr Seddik Ouahabi <aboubakr.ouahabi@innowise.com>
 *
 * This script scans generator/lib and runtime/lib directories for PHP files,
 * extracts namespace and class information, and generates class_alias statements
 * for backward compatibility.
 *
 * Usage: php generate_propel_aliases.php
 */
function scanDirectory($directory) {
    $aliases = [];

    if (!is_dir($directory)) {
        echo "Directory not found: $directory\n";
        return $aliases;
    }

    try {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::LEAVES_ONLY,
            RecursiveIteratorIterator::CATCH_GET_CHILD
        );

        foreach ($iterator as $file) {
            try {
                if ($file->isFile() && $file->getExtension() === 'php') {
                    $aliases = array_merge($aliases, extractClassInfo($file->getPathname()));
                }
            } catch (Exception $e) {
                echo "Warning: Could not process file {$file->getPathname()}: " . $e->getMessage() . "\n";
                continue;
            }
        }
    } catch (Exception $e) {
        echo "Error scanning directory $directory: " . $e->getMessage() . "\n";

        // Fallback to manual directory scanning
        echo "Attempting manual scan...\n";
        $aliases = scanDirectoryManual($directory);
    }

    return $aliases;
}

function scanDirectoryManual($directory, $aliases = []) {
    $files = scandir($directory);

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        $fullPath = $directory . DIRECTORY_SEPARATOR . $file;

        try {
            if (is_dir($fullPath) && !is_link($fullPath)) {
                // Recursively scan subdirectories
                $aliases = array_merge($aliases, scanDirectoryManual($fullPath, []));
            } elseif (is_file($fullPath) && pathinfo($fullPath, PATHINFO_EXTENSION) === 'php') {
                $aliases = array_merge($aliases, extractClassInfo($fullPath));
            }
        } catch (Exception $e) {
            echo "Warning: Could not process $fullPath: " . $e->getMessage() . "\n";
            continue;
        }
    }

    return $aliases;
}

function extractClassInfo($filepath) {
    $aliases = [];
    $content = file_get_contents($filepath);

    if ($content === false) {
        echo "Could not read file: $filepath\n";
        return $aliases;
    }

    // Extract namespace
    $namespace = null;
    if (preg_match('/^namespace\s+([^;]+);/m', $content, $matches)) {
        $namespace = trim($matches[1]);
    }

    // Skip files without namespace
    if (!$namespace) {
        return $aliases;
    }

    // Extract class, interface, and trait declarations
    $patterns = [
        '/^(?:abstract\s+)?class\s+([A-Za-z_][A-Za-z0-9_]*)/m',
        '/^interface\s+([A-Za-z_][A-Za-z0-9_]*)/m',
        '/^trait\s+([A-Za-z_][A-Za-z0-9_]*)/m'
    ];

    foreach ($patterns as $pattern) {
        if (preg_match_all($pattern, $content, $matches)) {
            foreach ($matches[1] as $className) {
                $fullClassName = $namespace . '\\' . $className;

                // Only add if the class name doesn't already exist in global namespace
                // and it's not already a namespaced class
                if (!str_contains($className, '\\')) {
                    $aliases[$className] = $fullClassName;
                }
            }
        }
    }

    return $aliases;
}

function generateAliasCode($aliases) {
    $code = "<?php\n";
    $code .= "/**\n";
    $code .= " * Propel Backward Compatibility Class Aliases\n";
    $code .= " * Generated on: " . date('Y-m-d H:i:s') . "\n";
    $code .= " * \n";
    $code .= " * This file provides backward compatibility by creating aliases\n";
    $code .= " * for namespaced Propel classes to their original global names.\n";
    $code .= " */\n\n";

    // Sort aliases alphabetically for better readability
    ksort($aliases);

    foreach ($aliases as $globalName => $namespacedName) {
        $code .= "if (!class_exists('$globalName') && !interface_exists('$globalName') && !trait_exists('$globalName')) {\n";
        $code .= "    class_alias('$namespacedName', '$globalName');\n";
        $code .= "}\n\n";
    }

    return $code;
}

function main() {
    echo "Propel Class Alias Generator\n";
    echo "===========================\n\n";

    $baseDir = __DIR__;

    // First, let's check what directories actually exist
    $possibleDirectories = [
        $baseDir . '/generator/lib',
        $baseDir . '/runtime/lib',
        $baseDir . '/lib',  // Sometimes Propel has a single lib directory
        $baseDir . '/src'   // Alternative structure
    ];

    $directories = [];
    foreach ($possibleDirectories as $dir) {
        if (is_dir($dir)) {
            $directories[] = $dir;
            echo "Found directory: $dir\n";
        } else {
            echo "Directory not found: $dir\n";
        }
    }

    if (empty($directories)) {
        echo "No valid directories found. Please check the script location.\n";
        echo "Current directory: $baseDir\n";
        echo "Available directories:\n";
        $items = scandir($baseDir);
        foreach ($items as $item) {
            if ($item !== '.' && $item !== '..' && is_dir($baseDir . '/' . $item)) {
                echo "  - $item/\n";
            }
        }
        return;
    }

    echo "\n";

    $allAliases = [];

    foreach ($directories as $directory) {
        echo "Scanning directory: $directory\n";
        $aliases = scanDirectory($directory);
        echo "Found " . count($aliases) . " classes/interfaces/traits\n\n";

        $allAliases = array_merge($allAliases, $aliases);
    }

    // Remove duplicates (in case same class is found in multiple places)
    $allAliases = array_unique($allAliases);

    echo "Total unique classes found: " . count($allAliases) . "\n\n";

    if (empty($allAliases)) {
        echo "No namespaced classes found. Nothing to generate.\n";
        return;
    }

    // Generate the alias code
    $aliasCode = generateAliasCode($allAliases);

    // Write to file
    $outputFile = $baseDir . '/propel_aliases.php';
    if (file_put_contents($outputFile, $aliasCode) !== false) {
        echo "Class aliases generated successfully!\n";
        echo "Output file: $outputFile\n\n";

        echo "To use these aliases, include this file early in your bootstrap:\n";
        echo "require_once 'path/to/propel_aliases.php';\n\n";

        echo "Sample of generated aliases:\n";
        echo "============================\n";
        $count = 0;
        foreach ($allAliases as $globalName => $namespacedName) {
            if ($count >= 10) {
                echo "... and " . (count($allAliases) - 10) . " more\n";
                break;
            }
            echo "$globalName -> $namespacedName\n";
            $count++;
        }
    } else {
        echo "Error: Could not write to $outputFile\n";
    }
}

// Run the script
main();