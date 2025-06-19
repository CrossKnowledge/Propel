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
/**
 * A validator for valid values (e.g. for enum fields)
 *
 * <code>
 *   <column name="address_type" type="VARCHAR" required="true" default="delivery" />
 *
 *   <validator column="address_type">
 *     <rule name="validValues" value="account|delivery" message="Please select a valid address type." />
 *   </validator>
 * </code>
 *
 * @author     Michael Aichler <aichler@mediacluster.de>
 * @version    $Revision$
 * @package    propel.runtime.validator
 */
class ValidValuesValidator implements BasicValidator
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
        return in_array($str, preg_split("/[|,]/", $map->getValue()));
    }
}
