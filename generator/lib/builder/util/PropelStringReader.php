<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */
namespace CK\Generator\Lib\Builder\Util;

use Reader;
//include_once 'phing/system/io/Reader.php';

/**
 * Overrides Phing's StringReader to allow inclusion inside a BufferedReader
 *
 * @author     François Zaninotto
 * @version    $Revision$
 * @package    propel.generator.builder.util
 */
class PropelStringReader extends Reader
{
    /**
     * @var string
     */
    protected string $_string;

    /**
     * @var int
     */
    protected int $mark = 0;

    /**
     * @var int
     */
    protected int $currPos = 0;

    public function __construct($string)
    {
        $this->_string = $string;
    }

    public function skip($n): void
    {
        $this->currPos = $this->currPos + $n;
    }

    public function eof(): bool
    {
        return $this->currPos == strlen($this->_string);
    }

    public function read($len = null): int|string
    {
        if ($len === null) {
            return $this->_string;
        } else {
            if ($this->currPos >= strlen($this->_string)) {
                return -1;
            }
            $out = substr($this->_string, $this->currPos, $len);
            $this->currPos += $len;

            return $out;
        }
    }

    public function mark(): void
    {
        $this->mark = $this->currPos;
    }

    public function reset(): void
    {
        $this->currPos = $this->mark;
    }

    public function close()
    {
    }

    public function open()
    {
    }

    public function ready()
    {
    }

    public function markSupported(): true
    {
        return true;
    }

    public function getResource(): string
    {
        return '(string) "' . $this->_string . '"';
    }
}
