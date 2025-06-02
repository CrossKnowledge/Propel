<?php

/**
 * Base class for Bookstore tests
 */

// Use the bootstrap - corrected path
require_once dirname(__FILE__) . '/../../../bootstrap.php';

// Import namespaced classes
use CK\Runtime\Lib\Propel;
use CK\Runtime\Lib\Exception\PropelException;
use PHPUnit\Framework\TestCase;

/**
 * Base class contains some methods useful for bookstore tests.
 */
abstract class BookstoreTestBase extends TestCase
{
    /**
     * @var boolean
     */
    protected $isInitialized = false;

    /**
     * This is run before each unit test.  It empties the database.
     * @throws PropelException
     */
    protected function setUp(): void
    {
        parent::setUp();
        if (!$this->isInitialized) {
            $this->initialize();
            $this->isInitialized = true;
        }
    }

    /**
     * Initialize Propel for testing
     * @throws PropelException
     */
    protected function initialize(): void
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
     * @throws PropelException
     */
    protected function getConnection()
    {
        return Propel::getConnection('bookstore');
    }
}