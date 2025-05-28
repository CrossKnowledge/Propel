<?php

/**
 * Base class for Bookstore tests
 */

// Use the bootstrap
require_once dirname(__FILE__) . '/../../../../bootstrap.php';

// Import namespaced classes
use CK\Runtime\Lib\Propel;
use CK\Runtime\Lib\Exception\PropelException;

/**
 * Base class contains some methods useful for bookstore tests.
 */
abstract class BookstoreTestBase extends PHPUnit_Framework_TestCase
{
    /**
     * @var boolean
     */
    protected $isInitialized = false;

    /**
     * This is run before each unit test.  It empties the database.
     */
    protected function setUp()
    {
        parent::setUp();
        if (!$this->isInitialized) {
            $this->initialize();
            $this->isInitialized = true;
        }
    }

    /**
     * Initialize Propel for testing
     */
    protected function initialize()
    {
        if (!Propel::isInit()) {
            // Configuration should already be loaded by bootstrap
            // but initialize if needed
            $configFile = TESTS_BASE_DIR . '/fixtures/bookstore/build/conf/bookstore-conf.php';
            if (file_exists($configFile)) {
                Propel::init($configFile);
            }
        }
    }

    /**
     * Get a connection to the database
     */
    protected function getConnection()
    {
        return Propel::getConnection('bookstore');
    }
}