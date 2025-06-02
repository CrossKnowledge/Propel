<?php
// Complete autoloader for both generator and runtime legacy class references

spl_autoload_register(function ($class) {
    // Remove any leading backslash
    $class = ltrim($class, '\\');

    // Generator namespace mappings
    $generatorMappings = [
        'task\\' => 'CK\\Generator\\Lib\\Task\\',
        'builder\\om\\' => 'CK\\Generator\\Lib\\Builder\\Om\\',
        'builder\\sql\\' => 'CK\\Generator\\Lib\\Builder\\Sql\\',
        'builder\\util\\' => 'CK\\Generator\\Lib\\Builder\\Util\\',
        'builder\\' => 'CK\\Generator\\Lib\\Builder\\',
        'platform\\' => 'CK\\Generator\\Lib\\Platform\\',
        'reverse\\' => 'CK\\Generator\\Lib\\Reverse\\',
        'behavior\\' => 'CK\\Generator\\Lib\\Behavior\\',
        'model\\' => 'CK\\Generator\\Lib\\Model\\',
        'model\\diff\\' => 'CK\\Generator\\Lib\\Model\\Diff\\',
        'config\\' => 'CK\\Generator\\Lib\\Config\\',
        'exception\\' => 'CK\\Generator\\Lib\\Exception\\',
        'util\\' => 'CK\\Generator\\Lib\\Util\\',
    ];

    // Runtime namespace mappings
    $runtimeMappings = [
        'adapter\\' => 'CK\\Runtime\\Lib\\Adapter\\',
        'collection\\' => 'CK\\Runtime\\Lib\\Collection\\',
        'connection\\' => 'CK\\Runtime\\Lib\\Connection\\',
        'formatter\\' => 'CK\\Runtime\\Lib\\Formatter\\',
        'logger\\' => 'CK\\Runtime\\Lib\\Logger\\',
        'map\\' => 'CK\\Runtime\\Lib\\Map\\',
        'om\\' => 'CK\\Runtime\\Lib\\Om\\',
        'parser\\' => 'CK\\Runtime\\Lib\\Parser\\',
        'query\\' => 'CK\\Runtime\\Lib\\Query\\',
        'validator\\' => 'CK\\Runtime\\Lib\\Validator\\',
    ];

    // Handle platform classes specifically (they're often referenced as platform/MysqlPlatform)
    if (strpos($class, 'platform/') === 0) {
        $platformClass = str_replace('/', '\\', $class);
        $shortName = substr($platformClass, strlen('platform\\'));
        $newClass = 'CK\\Generator\\Lib\\Platform\\' . $shortName;

        if (class_exists($newClass)) {
            class_alias($newClass, $class);
            return true;
        }
    }

    // Try generator mappings first
    foreach ($generatorMappings as $oldPrefix => $newNamespace) {
        if (strpos($class, $oldPrefix) === 0) {
            $shortName = substr($class, strlen($oldPrefix));
            $newClass = $newNamespace . $shortName;

            if (class_exists($newClass)) {
                class_alias($newClass, $class);
                return true;
            }
        }
    }

    // Try runtime mappings
    foreach ($runtimeMappings as $oldPrefix => $newNamespace) {
        if (strpos($class, $oldPrefix) === 0) {
            $shortName = substr($class, strlen($oldPrefix));
            $newClass = $newNamespace . $shortName;

            if (class_exists($newClass)) {
                class_alias($newClass, $class);
                return true;
            }
        }
    }

    // Handle special runtime classes that might not have a prefix
    $runtimeClasses = [
        'Propel' => 'CK\\Runtime\\Lib\\Propel',
        'BasePeer' => 'CK\\Runtime\\Lib\\Util\\BasePeer',
        'NodePeer' => 'CK\\Runtime\\Lib\\Util\\NodePeer',
        'Criteria' => 'CK\\Runtime\\Lib\\Query\\Criteria',
        'ModelCriteria' => 'CK\\Runtime\\Lib\\Query\\ModelCriteria',
        'PropelException' => 'CK\\Runtime\\Lib\\Exception\\PropelException',
        'PropelCollection' => 'CK\\Runtime\\Lib\\Collection\\PropelCollection',
        'PropelObjectCollection' => 'CK\\Runtime\\Lib\\Collection\\PropelObjectCollection',
        'PropelArrayCollection' => 'CK\\Runtime\\Lib\\Collection\\PropelArrayCollection',
        'PropelOnDemandCollection' => 'CK\\Runtime\\Lib\\Collection\\PropelOnDemandCollection',
        'PropelPDO' => 'CK\\Runtime\\Lib\\Connection\\PropelPDO',
    ];

    if (isset($runtimeClasses[$class])) {
        if (class_exists($runtimeClasses[$class])) {
            class_alias($runtimeClasses[$class], $class);
            return true;
        }
    }

    // Handle classes starting with Propel
    if (strpos($class, 'Propel') === 0 && strpos($class, '\\') === false) {
        // Try various namespaces
        $tryNamespaces = [
            'CK\\Generator\\Lib\\Task\\',
            'CK\\Generator\\Lib\\Model\\',
            'CK\\Generator\\Lib\\Util\\',
            'CK\\Generator\\Lib\\Builder\\',
            'CK\\Runtime\\Lib\\Util\\',
            'CK\\Runtime\\Lib\\Query\\',
            'CK\\Runtime\\Lib\\Collection\\',
            'CK\\Runtime\\Lib\\Connection\\',
            'CK\\Runtime\\Lib\\',
        ];

        foreach ($tryNamespaces as $ns) {
            $newClass = $ns . $class;
            if (class_exists($newClass)) {
                class_alias($newClass, $class);
                return true;
            }
        }
    }

    // Handle task. prefix (notice the dot instead of backslash)
    if (strpos($class, 'task.') === 0) {
        $taskClass = str_replace('.', '\\', $class);
        return spl_autoload_call($taskClass);
    }

    // Handle other dot-separated class names
    $dotPrefixes = ['builder.', 'platform.', 'model.', 'reverse.', 'behavior.', 'config.', 'util.', 'adapter.', 'collection.', 'connection.', 'formatter.', 'logger.', 'map.', 'om.', 'parser.', 'query.', 'validator.'];
    foreach ($dotPrefixes as $prefix) {
        if (strpos($class, $prefix) === 0) {
            $convertedClass = str_replace('.', '\\', $class);
            return spl_autoload_call($convertedClass);
        }
    }

    return false;
}, true, true);