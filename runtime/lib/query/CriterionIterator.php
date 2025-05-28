<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */
namespace CK\Runtime\Lib\Query;

use Iterator;
use ReturnTypeWillChange;

/**
 * Class that implements SPL Iterator interface.  This allows foreach () to
 * be used w/ Criteria objects.  Probably there is no performance advantage
 * to doing it this way, but it makes sense -- and simpler code.
 *
 * @author     Hans Lellelid <hans@xmpl.org>
 * @version    $Revision$
 * @package    propel.runtime.query
 */
class CriterionIterator implements Iterator
{

    private int $idx = 0;
    private Criteria $criteria;
    private array $criteriaKeys;
    private int $criteriaSize;

    public function __construct(Criteria $criteria)
    {
        $this->criteria = $criteria;
        $this->criteriaKeys = $criteria->keys();
        $this->criteriaSize = count($this->criteriaKeys);
    }

    #[ReturnTypeWillChange] public function rewind(): void
    {
        $this->idx = 0;
    }

    #[ReturnTypeWillChange] public function valid(): bool
    {
        return $this->idx < $this->criteriaSize;
    }

    #[ReturnTypeWillChange] public function key()
    {
        return $this->criteriaKeys[$this->idx];
    }

    #[ReturnTypeWillChange] public function current()
    {
        return $this->criteria->getCriterion($this->criteriaKeys[$this->idx]);
    }

    #[ReturnTypeWillChange] public function next(): void
    {
        $this->idx++;
    }
}
