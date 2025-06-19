<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license         MIT License
 */

namespace CK\Generator\Lib\Config;

use CK\Generator\Lib\Platform\PropelPlatformInterface;
use CK\Generator\Lib\Platform\SqlitePlatform;
use CK\Generator\Lib\Model\Table;
use CK\Generator\Lib\Builder\DataModelBuilder;
use CK\Propel\Generator\Lib\Builder\Util\Pluralizer;
use CK\Generator\Lib\Builder\Util\DefaultEnglishPluralizer;
use PDO;
use Exception;

//require_once dirname(__FILE__) . '/GeneratorConfig.php';
//require_once dirname(__FILE__) . '/GeneratorConfigInterface.php';
//require_once dirname(__FILE__) . '/../platform/PropelPlatformInterface.php';
//require_once dirname(__FILE__) . '/../platform/SqlitePlatform.php';

/**
 * @package propel.generator.config
 */
class QuickGeneratorConfig implements GeneratorConfigInterface
{
    protected array $builders = array(
        'peer'					=> 'CK\Generator\Lib\Builder\OM\PHP5PeerBuilder',
        'object'				=> 'CK\Generator\Lib\Builder\OM\PHP5ObjectBuilder',
        'objectstub'		    => 'CK\Generator\Lib\Builder\OM\PHP5ExtensionObjectBuilder',
        'peerstub'			    => 'CK\Generator\Lib\Builder\OM\PHP5ExtensionPeerBuilder',
        'objectmultiextend'     => 'CK\Generator\Lib\Builder\OM\PHP5MultiExtendObjectBuilder',
        'tablemap'			    => 'CK\Generator\Lib\Builder\OM\PHP5TableMapBuilder',
        'query'					=> 'CK\Generator\Lib\Builder\OM\QueryBuilder',
        'querystub'			    => 'CK\Generator\Lib\Builder\OM\ExtensionQueryBuilder',
        'queryinheritance'      => 'CK\Generator\Lib\Builder\OM\QueryInheritanceBuilder',
        'queryinheritancestub'  => 'CK\Generator\Lib\Builder\OM\ExtensionQueryInheritanceBuilder',
        'interface'			    => 'CK\Generator\Lib\Builder\OM\PHP5InterfaceBuilder',
        'node'					=> 'CK\Generator\Lib\Builder\OM\PHP5NodeBuilder',
        'nodepeer'			    => 'CK\Generator\Lib\Builder\OM\PHP5NodePeerBuilder',
        'nodestub'			    => 'CK\Generator\Lib\Builder\OM\PHP5ExtensionNodeBuilder',
        'nodepeerstub'	        => 'CK\Generator\Lib\Builder\OM\PHP5ExtensionNodePeerBuilder',
        'nestedset'			    => 'CK\Generator\Lib\Builder\OM\PHP5NestedSetBuilder',
        'nestedsetpeer'         => 'CK\Generator\Lib\Builder\OM\PHP5NestedSetPeerBuilder',
    );

    protected array $buildProperties  = [];

    private $generatorConfig    = null;

    private $configuredPlatform = null;

    /**
     * @throws Exception
     */
    public function __construct(PropelPlatformInterface $platform = null)
    {
        $this->configuredPlatform = $platform;
        $this->setBuildProperties($this->parsePseudoIniFile(dirname(__FILE__) . '/../../default.properties'));
    }

    /**
     * Why would Phing use ini while it so fun to invent a new format? (sic)
     * parse_ini_file() doesn't work for Phing property files
     * @throws Exception
     */
    protected function parsePseudoIniFile($filepath): array
    {
        $properties = [];
        if (($lines = @file($filepath)) === false) {
            throw new Exception("Unable to parse contents of $filepath");
        }
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line == "" || $line[0] == '#' || $line[0] == ';') {
                continue;
            }
            $pos = strpos($line, '=');
            $property = trim(substr($line, 0, $pos));
            $value = trim(substr($line, $pos + 1));
            if ($value === "true") {
                $value = true;
            } elseif ($value === "false") {
                $value = false;
            }
            $properties[$property] = $value;
        }

        return $properties;
    }

    /**
     * Gets a configured data model builder class for specified table and based on type.
     *
     * @param Table  $table
     * @param string $type  The type of builder ('ddl', 'sql', etc.)
     *
     * @return DataModelBuilder
     */
    public function getConfiguredBuilder(Table $table, string $type): DataModelBuilder
    {
        $class = $this->builders[$type];
        //require_once dirname(__FILE__) . '/../builder/om/' . $class . '.php';
        $builder = new $class($table);
        $builder->setGeneratorConfig($this);

        return $builder;
    }

    /**
     * Gets a configured Pluralizer class.
     *
     * @return Pluralizer
     */
    public function getConfiguredPluralizer(): Pluralizer
    {
        //require_once dirname(__FILE__) . '/../builder/util/DefaultEnglishPluralizer.php';

        return new DefaultEnglishPluralizer();
    }

    /**
     * Parses the passed-in properties, renaming and saving eligible properties in this object.
     *
     * Renames the propel.xxx properties to just xxx and renames any xxx.yyy properties
     * to xxxYyy as PHP doesn't like the xxx.yyy syntax.
     *
     * @param mixed $props Array or Iterator
     */
    public function setBuildProperties(mixed $props): void
    {
        $this->buildProperties = [];

        //$renamedPropelProps = array();    //Never used :/
        foreach ($props as $key => $propValue) {
            if (strpos($key, "propel.") === 0) {
                $newKey = substr($key, strlen("propel."));
                $j = strpos($newKey, '.');
                while ($j !== false) {
                    $newKey = substr($newKey, 0, $j) . ucfirst(substr($newKey, $j + 1));
                    $j = strpos($newKey, '.');
                }
                $this->setBuildProperty($newKey, $propValue);
            }
        }
    }

    /**
     * Gets a specific propel (renamed) property from the build.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function getBuildProperty(string $name): mixed
    {
        return $this->buildProperties[$name] ?? null;
    }

    /**
     * Sets a specific propel (renamed) property from the build.
     *
     * @param string $name
     * @param mixed $value
     */
    public function setBuildProperty(string $name, mixed $value): void
    {
        $this->buildProperties[$name] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguredPlatform(PDO $con = null, $database = null): SqlitePlatform|PropelPlatformInterface|null
    {
        if (null === $this->configuredPlatform) {
            return new SqlitePlatform($con);
        }

        $this->configuredPlatform->setConnection($con);

        return $this->configuredPlatform;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguredBehavior($name)
    {
        $this->initGeneratorConfig();

        return $this->generatorConfig->getConfiguredBehavior($name);
    }

    private function initGeneratorConfig(): void
    {
        if (null === $this->generatorConfig) {
            $this->generatorConfig = new GeneratorConfig();
            foreach ($this->buildProperties as $key => $value) {
                $this->generatorConfig->setBuildProperty($key, $value);
            }
        }
    }
}
