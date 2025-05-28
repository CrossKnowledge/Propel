<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */
namespace CK\Runtime\Lib\Formatter;

use CK\Runtime\Lib\Query\ModelCriteria;
use CK\Runtime\Lib\OM\BaseObject;
use CK\Runtime\Lib\Exception\PropelException;
use CK\Runtime\Lib\Propel;
use PDOStatement;
/**
 * Abstract class for query formatter
 *
 * @author     Francois Zaninotto
 * @version    $Revision$
 * @package    propel.runtime.formatter
 */
abstract class PropelFormatter
{
    protected
        $dbName,
        $class,
        $peer;
    protected
    array $currentObjects = array();
    protected
    array $with = array();
    protected
    array $asColumns = array();
    protected
    bool $hasLimit = false;

    public function __construct(ModelCriteria $criteria = null)
    {
        if (null !== $criteria) {
            $this->init($criteria);
        }
    }

    /**
     * Define the hydration schema based on a query object.
     * Fills the Formatter's properties using a Criteria as source
     *
     * @param ModelCriteria $criteria
     *
     * @return PropelFormatter The current formatter object
     */
    public function init(ModelCriteria $criteria): static
    {
        $this->dbName = $criteria->getDbName();
        $this->setClass($criteria->getModelName());
        $this->setWith($criteria->getWith());
        $this->asColumns = $criteria->getAsColumns();
        $this->hasLimit = $criteria->getLimit() != 0;

        return $this;
    }

    // DataObject getters & setters

    public function setDbName($dbName)
    {
        $this->dbName = $dbName;
    }

    public function getDbName()
    {
        return $this->dbName;
    }

    public function setClass($class): void
    {
        $this->class = $class;
        $this->peer = constant($this->class . '::PEER');
    }

    public function getClass()
    {
        return $this->class;
    }

    public function setPeer($peer): void
    {
        $this->peer = $peer;
    }

    public function getPeer()
    {
        return $this->peer;
    }

    public function setWith($withs = array()): void
    {
        $this->with = $withs;
    }

    public function getWith(): array
    {
        return $this->with;
    }

    public function setAsColumns($asColumns = array()): void
    {
        $this->asColumns = $asColumns;
    }

    public function getAsColumns()
    {
        return $this->asColumns;
    }

    public function setHasLimit($hasLimit = false): void
    {
        $this->hasLimit = $hasLimit;
    }

    public function hasLimit()
    {
        return $this->hasLimit;
    }

    /**
     * Formats an ActiveRecord object
     *
     * @param BaseObject|null $record the object to format
     *
     * @return BaseObject|null The original record
     */
    public function formatRecord(BaseObject $record = null): ?BaseObject
    {
        return $record;
    }

    abstract public function format(PDOStatement $stmt);

    abstract public function formatOne(PDOStatement $stmt);

    abstract public function isObjectFormatter();

    /**
     * @throws PropelException
     */
    public function checkInit(): void
    {
        if (null === $this->peer) {
            throw new PropelException('You must initialize a formatter object before calling format() or formatOne()');
        }
    }

    /**
     * @throws PropelException
     */
    public function getTableMap()
    {
        return Propel::getDatabaseMap($this->dbName)->getTableByPhpName($this->class);
    }

    protected function isWithOneToMany(): bool
    {
        foreach ($this->with as $modelWith) {
            if ($modelWith->isWithOneToMany()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Gets the worker object for the class.
     * To save memory, we don't create a new object for each row,
     * But we keep hydrating a single object per class.
     * The column offset in the row is used to index the array of classes
     * As there may be more than one object of the same class in the chain
     *
     * @param int $col   Offset of the object in the list of objects to hydrate
     * @param string $class Propel model object class
     *
     * @return BaseObject
     */
    protected function getWorkerObject(int $col, string $class): BaseObject
    {
        $key = $col . '_' . $class;

        if (isset($this->currentObjects[$key])) {
            $this->currentObjects[$key]->clear();
        } else {
            $this->currentObjects[$key] = new $class();
        }

        return $this->currentObjects[$key];
    }

    /**
     * Gets a Propel object hydrated from a selection of columns in statement row
     *
     * @param array $row associative array indexed by column number,
     *                   as returned by PDOStatement::fetch(PDO::FETCH_NUM)
     * @param string $class The classname of the object to create
     * @param int $col   The start column for the hydration (modified)
     *
     * @return BaseObject
     */
    public function getSingleObjectFromRow(array $row, string $class, int &$col = 0): BaseObject
    {
        $obj = $this->getWorkerObject($col, $class);
        $col = $obj->hydrate($row, $col);

        return $obj;
    }
}
