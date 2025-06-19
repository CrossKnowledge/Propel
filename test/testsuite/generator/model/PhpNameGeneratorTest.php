<?php
use PHPUnit\Framework\TestCase;

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

require_once dirname(__FILE__) . '/../../../../generator/lib/model/PhpNameGenerator.php';
use PHPUnit\Framework\TestCase;

/**
 * Tests for PhpNameGenerator
 *
 * @author     <a href="mailto:mpoeschl@marmot.at>Martin Poeschl</a>
 * @version    $Revision$
 * @package    generator.model
 */
class PhpNameGeneratorTest extends TestCase
{
    public static function phpnameMethodDataProvider()
use PHPUnit\Framework\TestCase;
    {
        return array(
            array('foo', 'Foo'),
            array('Foo', 'Foo'),
            array('FOO', 'FOO'),
            array('123', '123'),
            array('foo_bar', 'FooBar'),
            array('bar_1', 'Bar1'),
            array('bar_0', 'Bar0'),
            array('my_CLASS_name', 'MyCLASSName'),
        );
    }

    /**
     * @dataProvider phpnameMethodDataProvider
use PHPUnit\Framework\TestCase;
     */
    public function testPhpnameMethod($input, $output)
    {
        $generator = new TestablePhpNameGenerator();
        $this->assertEquals($output, $generator->phpnameMethod($input));
use PHPUnit\Framework\TestCase;
    }

    public static function underscoreMethodDataProvider()
    {
        return array(
            array('foo', 'Foo'),
            array('Foo', 'Foo'),
            array('Foo', 'Foo'),
            array('123', '123'),
            array('foo_bar', 'FooBar'),
            array('bar_1', 'Bar1'),
            array('bar_0', 'Bar0'),
            array('my_CLASS_name', 'MyClassName'),
        );
    }

    /**
     * @dataProvider underscoreMethodDataProvider
     */
    public function testUnderscoreMethod($input, $output)
    {
        $generator = new TestablePhpNameGenerator();
        $this->assertEquals($output, $generator->underscoreMethod($input));
    }

}

class TestablePhpNameGenerator extends PhpNameGenerator
{
    public function phpnameMethod($schemaName)
use PHPUnit\Framework\TestCase;
    {
        return parent::phpnameMethod($schemaName);
use PHPUnit\Framework\TestCase;
    }

    public function underscoreMethod($schemaName)
    {
        return parent::underscoreMethod($schemaName);
    }
}
