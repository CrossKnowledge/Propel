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
 * A validator for required fields.
 *
 * Below is an example usage for your Propel xml schema file.
 *
 * <code>
 *   <column name="username" type="VARCHAR" size="25" required="true" />
 *
 *   <validator column="username">
 *     <rule name="required" message="Username is required." />
 *   </validator>
 * </code>
 *
 * @author     Michael Aichler <aichler@mediacluster.de>
 * @version    $Revision$
 * @package    propel.runtime.validator
 */
class RequiredValidator implements BasicValidator
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
        return ($str !== null && $str !== ""); //This is already evaluated, so it should be just ($str !== "")
    }
}
