<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */
namespace CK\Runtime\Lib\Collection;

use Iterator;
use CK\Runtime\Lib\Formatter\PropelFormatter;
use CK\Runtime\Lib\Formatter\PropelObjectFormatter;
use CK\Runtime\Lib\Propel;
use CK\Runtime\Lib\OM\BaseObject;
use CK\Runtime\Lib\Exception\PropelException;
use PDO;
use PDOStatement;
use ReturnTypeWillChange;

/**
 * Class for iterating over a statement and returning one Propel object at a time
 *
 * @author     Francois Zaninotto
 * @package    propel.runtime.collection
 */
class PropelOnDemandIterator implements Iterator
{
    /**
     * @ var PropelObjectFormatter
     * @var PropelFormatter|PropelObjectFormatter
     */
    protected PropelFormatter|PropelObjectFormatter $formatter;

    /**
     * @var PDOStatement
     */
    protected PDOStatement $stmt;

    protected $currentRow;

    protected int $currentKey = -1;

    /**
     * @var boolean|null
     */
    protected ?bool $isValid = null;

    /**
     * @var boolean
     */
    protected bool $enableInstancePoolingOnFinish = false;

    /**
     * @param PropelFormatter $formatter
     * @param PDOStatement    $stmt
     */
    public function __construct(PropelFormatter $formatter, PDOStatement $stmt)
    {
        $this->formatter = $formatter;
        $this->stmt = $stmt;
        $this->enableInstancePoolingOnFinish = Propel::disableInstancePooling();
    }

    public function closeCursor(): void
    {
        $this->stmt->closeCursor();
    }

    /**
     * Returns the number of rows in the resultset
     * Warning: this number is inaccurate for most databases. Do not rely on it for a portable application.
     *
     * @return integer Number of results
     */
    public function count(): int
    {
        return $this->stmt->rowCount();
    }

    /**
     * Gets the current Model object in the collection
     * This is where the hydration takes place.
     *
     * @see PropelObjectFormatter::getAllObjectsFromRow()
     *
     * @return BaseObject
     */
    #[ReturnTypeWillChange] public function current(): BaseObject
    {
        return $this->formatter->getAllObjectsFromRow($this->currentRow);
    }

    /**
     * Gets the current key in the iterator
     *
     * @ return string
     * @return int|string
     */
    #[ReturnTypeWillChange] public function key(): int|string
    {
        return $this->currentKey;
    }

    /**
     * Advances the cursor in the statement
     * Closes the cursor if the end of the statement is reached
     */
    #[ReturnTypeWillChange] public function next(): void
    {
        $this->currentRow = $this->stmt->fetch(PDO::FETCH_NUM);
        $this->currentKey++;
        $this->isValid = (boolean) $this->currentRow;
        if (!$this->isValid) {
            $this->closeCursor();
            if ($this->enableInstancePoolingOnFinish) {
                Propel::enableInstancePooling();
            }
        }
    }

    /**
     * Initializes the iterator by advancing to the first position
     * This method can only be called once (this is a NoRewindIterator)
     * @throws PropelException
     */
    #[ReturnTypeWillChange] public function rewind(): void
    {
        // check that the hydration can begin
        if (null === $this->formatter) {
            throw new PropelException('The On Demand collection requires a formatter. Add it by calling setFormatter()');
        }
        if (null === $this->stmt) {
            throw new PropelException('The On Demand collection requires a statement. Add it by calling setStatement()');
        }
        if (null !== $this->isValid) {
            throw new PropelException('The On Demand collection can only be iterated once');
        }

        // initialize the current row and key
        $this->next();
    }

    /**
     * @return boolean
     */
    #[ReturnTypeWillChange] public function valid(): bool
    {
        return (boolean) $this->isValid;
    }
}
