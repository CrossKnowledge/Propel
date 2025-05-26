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
use CK\Runtime\Lib\Exception\PropelException;
/**
 * A validator for validating the (PHP) type of the value submitted.
 *
 * <code>
 *   <column name="some_int" type="INTEGER" required="true"/>
 *
 *   <validator column="some_int">
 *     <rule name="type" value="integer" message="Please specify an integer value for some_int column." />
 *   </validator>
 * </code>
 *
 * @author     Hans Lellelid <hans@xmpl.org>
 * @version    $Revision$
 * @package    propel.runtime.validator
 */
class TypeValidator implements BasicValidator
{
    /**
     * @param ValidatorMap $map
     * @param string        $str
     *
     * @return boolean
     *
     * @throws PropelException
     *@see       BasicValidator::isValid()
     *
     */
    public function isValid(ValidatorMap $map, mixed $str): bool
    {
        //Using match is faster and more efficient here:
        return match ($map->getValue()) {
            'array' => is_array($str),
            'bool', 'boolean' => is_bool($str),
            'float' => is_float($str),
            'int', 'integer' => is_int($str),
            'numeric' => is_numeric($str),
            'object' => is_object($str),
            'resource' => is_resource($str),
            'scalar' => is_scalar($str),
            'string' => is_string($str),
            'function' => function_exists($str),
            default => throw new PropelException('Unknown type ' . $map->getValue()),
        };

        /*switch ($map->getValue()) {
            case 'array':
                return is_array($str);
                break;
            case 'bool':
            case 'boolean':
                return is_bool($str);
                break;
            case 'float':
                return is_float($str);
                break;
            case 'int':
            case 'integer':
                return is_int($str);
                break;
            case 'numeric':
                return is_numeric($str);
                break;
            case 'object':
                return is_object($str);
                break;
            case 'resource':
                return is_resource($str);
                break;
            case 'scalar':
                return is_scalar($str);
                break;
            case 'string':
                return is_string($str);
                break;
            case 'function':
                return function_exists($str);
                break;
            default:
                throw new PropelException('Unknown type ' . $map->getValue());
                break;
        }*/
    }
}
