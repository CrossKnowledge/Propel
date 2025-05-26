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
 * A validator for regular expressions.
 *
 * This validator will return true, when the passed value *matches* the
 * regular expression.
 *
 * ## This class replaces the former class MaskValidator ##
 *
 * If you do want to test if the value does *not* match an expression,
 * you can use the MatchValidator class instead.
 *
 * Below is an example usage for your Propel xml schema file.
 *
 * <code>
 *   <column name="email" type="VARCHAR" size="128" required="true" />
 *   <validator column="username">
 *     <!-- allow strings that match the email address pattern -->
 *     <rule
 *       name="match"
 *       value="/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9])+(\.[a-zA-Z0-9_-]+)+$/"
 *       message="Please enter a valid email address." />
 *   </validator>
 * </code>
 *
 * @author     Michael Aichler <aichler@mediacluster.de>
 * @author     Hans Lellelid <hans@xmpl.org>
 * @version    $Revision$
 * @package    propel.runtime.validator
 */
class MatchValidator implements BasicValidator
{
    /**
     * Prepares the regular expression entered in the XML
     * for use with preg_match().
     *
     * @param string $exp
     *
     * @return string Prepared regular expression.
     */
    private function prepareRegexp(string $exp): string
    {
        // remove surrounding '/' marks so that they don't get escaped in next step
        if ($exp[0] !== '/' || $exp[strlen($exp) - 1] !== '/') {
            $exp = '/' . $exp . '/';
        }

        // if they did not escape / chars; we do that for them
        return preg_replace('/([^\\\])\/([^$])/', '$1\/$2', $exp);
    }

    /**
     * Whether the passed string matches regular expression.
     *
     * @param ValidatorMap $map
     * @param string $str
     *
     * @return boolean
     */
    public function isValid(ValidatorMap $map, string $str): bool
    {
        return (preg_match($this->prepareRegexp($map->getValue()), $str) != 0);
    }
}
