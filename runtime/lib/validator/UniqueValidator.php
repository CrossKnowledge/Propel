<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */
namespace CK\Runtime\Lib\Validator;

use CK\Runtime\Lib\Map\ValidatorMap;
use CK\Runtime\Lib\Query\Criteria;
/**
 * A validator for unique column names.
 *
 * <code>
 *   <column name="username" type="VARCHAR" size="25" required="true" />
 *
 *   <validator column="username">
 *     <rule name="unique" message="Username already exists !" />
 *   </validator>
 * </code>
 *
 * @author     Michael Aichler <aichler@mediacluster.de>
 * @version    $Revision$
 * @package    propel.runtime.validator
 */
class UniqueValidator implements BasicValidator
{
    /**
     * @param ValidatorMap $map
     * @param string       $str
     *
     * @return boolean
     * @see       BasicValidator::isValid()
     *
     */
    public function isValid(ValidatorMap $map, string $str): bool
    {
        $column = $map->getColumn();

        $c = new Criteria();
        $c->add($column->getFullyQualifiedName(), $str, Criteria::EQUAL);

        $table = $column->getTable()->getClassName();

        $clazz = $table . 'Peer';
        $count = call_user_func(array($clazz, 'doCount'), $c);

        return ($count === 0);
    }
}
