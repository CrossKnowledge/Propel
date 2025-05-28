<?php
/**
 * Converts XML configuration to array format for namespaced Propel
 */

function convertXMLConfigToArray($xmlFile) {
    if (!file_exists($xmlFile)) {
        return [];
    }

    $xml = simplexml_load_file($xmlFile);
    $config = [];

    if (isset($xml->propel)) {
        $propelConfig = $xml->propel;

        // Convert datasources
        if (isset($propelConfig->datasources)) {
            $config['datasources'] = [];
            $config['datasources']['default'] = (string)$propelConfig->datasources['default'];

            foreach ($propelConfig->datasources->datasource as $datasource) {
                $dsId = (string)$datasource['id'];
                $config['datasources'][$dsId] = [
                    'adapter' => (string)$datasource->adapter,
                    'connection' => [
                        'dsn' => (string)$datasource->connection->dsn,
                        'user' => (string)$datasource->connection->user,
                        'password' => (string)$datasource->connection->password,
                        'classname' => (string)$datasource->connection->classname,
                    ]
                ];

                // Add options if present
                if (isset($datasource->connection->options)) {
                    $config['datasources'][$dsId]['connection']['options'] = [];
                    foreach ($datasource->connection->options->option as $option) {
                        $id = (string)$option['id'];
                        $value = (string)$option;
                        $config['datasources'][$dsId]['connection']['options'][$id] = [
                            'value' => $value === 'true' ? true : ($value === 'false' ? false : $value)
                        ];
                    }
                }

                // Add attributes if present
                if (isset($datasource->connection->attributes)) {
                    $config['datasources'][$dsId]['connection']['attributes'] = [];
                    foreach ($datasource->connection->attributes->option as $attr) {
                        $id = (string)$attr['id'];
                        $value = (string)$attr;
                        $config['datasources'][$dsId]['connection']['attributes'][$id] = [
                            'value' => $value === 'true' ? true : ($value === 'false' ? false : $value)
                        ];
                    }
                }

                // Add settings if present
                if (isset($datasource->connection->settings)) {
                    $config['datasources'][$dsId]['connection']['settings'] = [];
                    foreach ($datasource->connection->settings->setting as $setting) {
                        $id = (string)$setting['id'];
                        $value = (string)$setting;
                        $config['datasources'][$dsId]['connection']['settings'][$id] = $value;
                    }
                }
            }
        }
    }

    return ['propel' => $config];
}

// Return the converted config
$xmlConfigFile = TESTS_BASE_DIR . '/fixtures/bookstore/runtime-conf.xml';
return convertXMLConfigToArray($xmlConfigFile);