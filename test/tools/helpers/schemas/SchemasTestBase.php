<?php
use PHPUnit\Framework\TestCase;

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

require_once dirname(__FILE__) . '/../../../../runtime/lib/Propel.php';
use PHPUnit\Framework\TestCase;
set_include_path(get_include_path() . PATH_SEPARATOR . realpath(dirname(__FILE__) . '/../../../fixtures/schemas/build/classes'));

/**
 * Bse class for tests on the schemas schema
 */
abstract class SchemasTestBase extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        if (!file_exists(dirname(__FILE__) . '/../../../fixtures/schemas/build/conf/bookstore-conf.php')) {
use PHPUnit\Framework\TestCase;
            $this->markTestSkipped('You must build the schemas project fot this tests to run');
        }
        Propel::init(dirname(__FILE__) . '/../../../fixtures/schemas/build/conf/bookstore-conf.php');
use PHPUnit\Framework\TestCase;
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Propel::init(dirname(__FILE__) . '/../../../fixtures/bookstore/build/conf/bookstore-conf.php');
use PHPUnit\Framework\TestCase;
    }
}
