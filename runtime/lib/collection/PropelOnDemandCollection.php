<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */
namespace CK\Runtime\Lib\Collection;

use CK\Runtime\Lib\Formatter\PropelFormatter;
use CK\Runtime\Lib\Exception\PropelException;
use PDOStatement;
use ReturnTypeWillChange;

/**
 * Class for iterating over a statement and returning one Propel object at a time
 *
 * @author     Francois Zaninotto
 * @package    propel.runtime.collection
 */
class PropelOnDemandCollection extends PropelCollection
{
    /**
     * @var       PropelOnDemandIterator
     */
    //protected \ArrayIterator $iterator;
    protected PropelOnDemandIterator $iterator;

    /**
     * @param PropelFormatter $formatter
     * @param PDOStatement    $stmt
     */
    public function initIterator(PropelFormatter $formatter, PDOStatement $stmt): void
    {
        $this->iterator = new PropelOnDemandIterator($formatter, $stmt);
    }

    /**
     * Populates the collection from an array
     * Each object is populated from an array and the result is stored
     * Does not empty the collection before adding the data from the array
     *
     * @param array $arr
     *
     * @throws PropelException
     */
    public function fromArray($arr)
    {
        throw new PropelException('The On Demand Collection is read only');
    }

    // IteratorAggregate Interface

    /**
     * @return PropelOnDemandIterator
     */
    public function getIterator(): PropelOnDemandIterator
    {
        return $this->iterator;
    }

    // ArrayAccess Interface

    /**
     * @throws PropelException
     *
     * @param integer $offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        throw new PropelException('The On Demand Collection does not allow access by offset');
    }

    /**
     * @throws PropelException
     *
     * @param integer $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        throw new PropelException('The On Demand Collection does not allow access by offset');
    }

    /**
     * @throws PropelException
     *
     * @param integer $offset
     * @param mixed   $value
     */
    public function offsetSet($offset, $value)
    {
        throw new PropelException('The On Demand Collection is read only');
    }

    /**
     * @throws PropelException
     *
     * @param integer $offset
     */
    public function offsetUnset($offset)
    {
        throw new PropelException('The On Demand Collection is read only');
    }

    // Serializable Interface

    /**
     * @throws PropelException
     */
    public function serialize(): string
    {
        throw new PropelException('The On Demand Collection cannot be serialized');
    }

    /**
     * @param string $data
     *
     * @return void
     * @throws PropelException
     *
     */
    public function unserialize(string $data): void
    {
        throw new PropelException('The On Demand Collection cannot be serialized');
    }

    // Countable Interface

    /**
     * Returns the number of rows in the resultset
     * Warning: this number is inaccurate for most databases. Do not rely on it for a portable application.
     *
     * @return integer Number of results
     */
    public function count()
    {
        return $this->iterator->count();
    }

    // ArrayObject methods

    public function append($value)
    {
        throw new PropelException('The On Demand Collection is read only');
    }

    public function prepend(mixed $value)
    {
        throw new PropelException('The On Demand Collection is read only');
    }

    public function asort()
    {
        throw new PropelException('The On Demand Collection is read only');
    }

    public function exchangeArray($input)
    {
        throw new PropelException('The On Demand Collection is read only');
    }

    public function getArrayCopy()
    {
        throw new PropelException('The On Demand Collection does not allow access by offset');
    }

    public function getFlags()
    {
        throw new PropelException('The On Demand Collection does not allow access by offset');
    }

    #[ReturnTypeWillChange] public function ksort(int $flags = SORT_REGULAR)
    {
        throw new PropelException('The On Demand Collection is read only');
    }

    public function natcasesort()
    {
        throw new PropelException('The On Demand Collection is read only');
    }

    public function natsort()
    {
        throw new PropelException('The On Demand Collection is read only');
    }

    public function setFlags($flags)
    {
        throw new PropelException('The On Demand Collection does not allow acces by offset');
    }

    public function uasort($cmp_function)
    {
        throw new PropelException('The On Demand Collection is read only');
    }

    public function uksort($cmp_function)
    {
        throw new PropelException('The On Demand Collection is read only');
    }

    /**
     * {@inheritdoc}
     */
    public function exportTo(mixed $parser, bool $usePrefix = true, bool $includeLazyLoadColumns = true): string
    {
        throw new PropelException('A PropelOnDemandCollection cannot be exported.');
    }
}
