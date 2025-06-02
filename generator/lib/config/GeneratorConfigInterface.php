<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license         MIT License
 */

namespace CK\Generator\Lib\Config;

use CK\Generator\Lib\Model\Table;
use CK\Generator\Lib\Builder\DataModelBuilder;
use CK\Propel\Generator\Lib\Builder\Util\Pluralizer;
use PDO;
/**
 * @package      propel.generator.config
 */
interface GeneratorConfigInterface
{
    /**
     * Gets a configured data model builder class for specified table and based on type.
     *
     * @param Table  $table
     * @param string $type  The type of builder ('ddl', 'sql', etc.)
     *
     * @return DataModelBuilder
     */
    public function getConfiguredBuilder(Table $table, string $type): DataModelBuilder;

    /**
     * Gets a configured Pluralizer class.
     *
     * @return Pluralizer
     */
    public function getConfiguredPluralizer(): Pluralizer;

    /**
     * Gets a specific propel (renamed) property from the build.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function getBuildProperty(string $name): mixed;

    /**
     * Sets a specific propel (renamed) property from the build.
     *
     * @param string $name
     * @param mixed  $value
     */
    public function setBuildProperty(string $name, mixed $value);

    /**
     * Creates and configures a new Platform class.
     */
    public function getConfiguredPlatform(PDO $con = null, $database = null);

    /**
     * Gets a configured behavior class
     */
    public function getConfiguredBehavior($name);
}
