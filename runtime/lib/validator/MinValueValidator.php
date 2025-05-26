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
 * A validator for minimum values.
 *
 * Below is an example usage for your Propel xml schema file.
 *
 * <code>
 *   <column name="articles" type="INTEGER" required="true" />
 *
 *   <validator column="articles">
 *     <rule name="minValue" value="1"  message="Minimum value for selected articles is ${value} !" />
 *     <rule name="maxValue" value="10"  message="Maximum value for selected articles is ${value} !" />
 *   </validator>
 * </code>
 *
 * @author     Michael Aichler <aichler@mediacluster.de>
 * @version    $Revision$
 * @package    propel.runtime.validator
 */
class MinValueValidator implements BasicValidator
{
    /**
     * @param ValidatorMap $map
     * @param string        $str
     *
     * @return boolean
     * @see       BasicValidator::isValid()
     *
     */
    public function isValid(ValidatorMap $map, string $str): bool
    {
        //if (is_null($str) == false && is_numeric($str)) { //Again with the complexity?
        if (is_numeric($str)) {
            return intval($str) >= intval($map->getValue());
        }

        return false;
    }
}
