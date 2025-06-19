<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */
namespace CK\Runtime\Lib\Adapter;

use PDO;
/**
 * This is used in order to connect to a SQLite database.
 *
 * @author     Hans Lellelid <hans@xmpl.org>
 * @version    $Revision$
 * @package    propel.runtime.adapter
 */
class DBSQLite extends DBAdapter
{

    /**
     * For SQLite this method has no effect, since SQLite doesn't support specifying a character
     * set (or, another way to look at it, it doesn't require a single character set per DB).
     *
     * @param PDO    $con     A PDO connection instance.
     * @param string $charset The charset encoding.
     *
     * @ throws PropelException If the specified charset doesn't match sqlite_libencoding()
     */
    public function setCharset(PDO $con, string $charset): void
    {
    }

    /**
     * This method is used to ignore case.
     *
     * @param string $in The string to transform to upper case.
     *
     * @return string The upper case string.
     */
    public function toUpperCase(string $in): string
    {
        return 'UPPER(' . $in . ')';
    }

    /**
     * This method is used to ignore case.
     *
     * @param string $in The string whose case to ignore.
     *
     * @return string The string in a case that can be ignored.
     */
    public function ignoreCase(string $in): string
    {
        return 'UPPER(' . $in . ')';
    }

    /**
     * Returns SQL which concatenates the second string to the first.
     *
     * @param string $s1 String to concatenate.
     * @param string $s2 String to append.
     *
     * @return string
     */
    public function concatString(string $s1, string $s2): string
    {
        return "($s1 || $s2)";
    }

    /**
     * Returns SQL which extracts a substring.
     *
     * @param string $s   String to extract from.
     * @param integer $pos Offset to start from.
     * @param integer $len Number of characters to extract.
     *
     * @return string
     */
    public function subString(string $s, int $pos, int $len): string
    {
        return "substr($s, $pos, $len)";
    }

    /**
     * Returns SQL which calculates the length (in chars) of a string.
     *
     * @param string $s String to calculate length of.
     *
     * @return string
     */
    public function strLength(string $s): string
    {
        return "length($s)";
    }

    /**
     * @param string $text
     *
     * @return string
     *@see        DBAdapter::quoteIdentifier()
     *
     */
    public function quoteIdentifier(string $text): string
    {
        return '[' . $text . ']';
    }

    /**
     * @param string  $sql
     * @param integer $offset
     * @param integer $limit
     *@see        DBAdapter::applyLimit()
     *
     */
    public function applyLimit(string &$sql, int $offset, int $limit): void
    {
        if ($limit > 0) {
            $sql .= " LIMIT " . $limit . ($offset > 0 ? " OFFSET " . $offset : "");
        } elseif ($offset > 0) {
            $sql .= " LIMIT -1 OFFSET " . $offset;
        }
    }

    /**
     * @param mixed|null $seed
     *
     * @return string
     */
    public function random(mixed $seed = null): string
    {
        return 'random()';
    }
}
