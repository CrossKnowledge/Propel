<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

require_once dirname(__FILE__) . '/../../../../generator/lib/config/GeneratorConfig.php';

use PHPUnit\Framework\TestCase;
use Phing\Io\File;
use Phing\Phing;
use Phing\Project;
use Phing\Task\System\PropertyTask;

class GeneratorConfigPropertiesTest extends TestCase
{
    public static function propertyValuesProvider()
    {
        return array(
            'string false' => array('false', false),
            'string true' => array('true', true),
            'boolean false' => array(false, false),
            'boolean true' => array(true, true),
            'empty string' => array('', ''),
            'zero string' => array('0', '0'),
            'integer' => array(10, 10),
            'null' => array(null, null),
            'date format' => array('Y-m-d H:i:s', 'Y-m-d H:i:s'),
            'namespace' => array('om', 'om'),
            'class name' => array('builder.om.PHP5ObjectBuilder', 'builder.om.PHP5ObjectBuilder'),
        );
    }

    /**
     * @dataProvider propertyValuesProvider
     */
    public function testSetBuildPropertyNormalizesBooleanStrings($value, $expected)
    {
        $config = new GeneratorConfig();
        $config->setBuildProperty('test', $value);

        $this->assertSame($expected, $config->getBuildProperty('test'));
        $this->assertSame(array('test' => $expected), $config->getBuildProperties());
    }

    public function testSetBuildPropertiesNormalizesValuesAndNames()
    {
        $config = new GeneratorConfig(new ArrayIterator(array(
            'propel.addTimeStamp' => 'false',
            'propel.schema.validate' => 'true',
            'propel.namespace.om' => 'om',
            'other.property' => 'false',
        )));

        $this->assertSame(array(
            'addTimeStamp' => false,
            'schemaValidate' => true,
            'namespaceOm' => 'om',
        ), $config->getBuildProperties());

        $config->setBuildProperties(array('propel.addTimeStamp' => 'true'));
        $this->assertSame(array('addTimeStamp' => true), $config->getBuildProperties());
    }

    public static function propertiesFilesProvider()
    {
        return array(
            array('default.properties'),
            array('build.properties'),
        );
    }

    /**
     * @dataProvider propertiesFilesProvider
     */
    public function testPropertiesLoadedByPhingKeepTheirMeaning($filename)
    {
        Phing::startup();
        $project = new Project();
        $task = new PropertyTask();
        $task->setProject($project);
        $task->setFile(new File(dirname(__FILE__) . '/../../../../generator/' . $filename));
        $task->main();

        $config = new GeneratorConfig($project->getProperties());

        $this->assertSame(false, $config->getBuildProperty('addTimeStamp'));
        $this->assertSame(false, $config->getBuildProperty('emulateForeignKeyConstraints'));
        $this->assertSame(false, $config->getBuildProperty('addIncludes'));
        $this->assertSame(true, $config->getBuildProperty('addSaveMethod'));
        $this->assertSame(true, $config->getBuildProperty('addClassLevelComment'));
        $this->assertSame('om', $config->getBuildProperty('namespaceOm'));
        $this->assertSame('Y-m-d H:i:s', $config->getBuildProperty('defaultTimeStampFormat'));
    }
}
