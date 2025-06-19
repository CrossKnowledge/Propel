<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */
namespace CK\Runtime\Lib\Adapter;


use CK\Runtime\Lib\Query\ModelCriteria;
use CK\Runtime\Lib\Map\ColumnMap;
use CK\Runtime\Lib\Exception\PropelException;
use CK\Runtime\Lib\Connection\PropelPDO;
use CK\Runtime\Lib\Propel;
use CK\Runtime\Lib\Util\BasePeer;
use PDOException;
use PDOStatement;
use PDO;

/**
 * This is used in order to connect to a MySQL database.
 *
 * @author     Hans Lellelid <hans@xmpl.org> (Propel)
 * @author     Jon S. Stevens <jon@clearink.com> (Torque)
 * @author     Brett McLaughlin <bmclaugh@algx.net> (Torque)
 * @author     Daniel Rall <dlr@finemaltcoding.com> (Torque)
 * @version    $Revision$
 * @package    propel.runtime.adapter
 */
class DBMySQL extends DBAdapter
{
    /**
     * This method is used to ignore case.
     *
     * @param string $in The string to transform to upper case.
     *
     * @return string The upper case string.
     */
    public function toUpperCase(string $in): string
    {
        return "UPPER(" . $in . ")";
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
        return "UPPER(" . $in . ")";
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
        return "CONCAT($s1, $s2)";
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
        return "SUBSTRING($s, $pos, $len)";
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
        return "CHAR_LENGTH($s)";
    }

    /**
     * Locks the specified table.
     *
     * @param PDO    $con   The Propel connection to use.
     * @param string $table The name of the table to lock.
     *
     * @throws PDOException No Statement could be created or executed.
     */
    public function lockTable(PDO $con, string $table): void
    {
        $con->exec("LOCK TABLE " . $table . " WRITE");
    }

    /**
     * Unlocks the specified table.
     *
     * @param PDO    $con   The PDO connection to use.
     * @param string $table The name of the table to unlock.
     *
     * @throws PDOException No Statement could be created or executed.
     */
    public function unlockTable(PDO $con, string $table): void
    {
        $statement = $con->exec("UNLOCK TABLES");
    }

    /**
     * @param string $text
     *
     * @return string
     *@see       DBAdapter::quoteIdentifier()
     *
     */
    public function quoteIdentifier(string $text): string
    {
        return '`' . $text . '`';
    }

    /**
     * @param string $table
     *
     * @return string
     *@see       DBAdapter::quoteIdentifierTable()
     *
     */
    public function quoteIdentifierTable(string $table): string
    {
        // e.g. 'database.table alias' should be escaped as '`database`.`table` `alias`'
        return '`' . strtr($table, array('.' => '`.`', ' ' => '` `')) . '`';
    }

    /**
     * @see       DBAdapter::useQuoteIdentifier()
     *
     * @return boolean
     */
    public function useQuoteIdentifier(): bool
    {
        return true;
    }

    /**
     * @param string  $sql
     * @param integer $offset
     * @param integer $limit
     *@see       DBAdapter::applyLimit()
     *
     */
    public function applyLimit(string &$sql, int $offset, int $limit): void
    {
        if ($limit > 0) {
            $sql .= " LIMIT " . ($offset > 0 ? $offset . ", " : "") . $limit;
        } elseif ($offset > 0) {
            $sql .= " LIMIT " . $offset . ", 18446744073709551615";
        }
    }

    /**
     * @param mixed|null $seed
     *
     * @return string
     * @see       DBAdapter::random()
     *
     */
    public function random(mixed $seed = null): string
    {
        return 'rand(' . ((int) $seed) . ')';
    }

    /**
     * @param PDOStatement $stmt
     * @param string $parameter
     * @param mixed $value
     * @param ColumnMap $cMap
     * @param integer|null $position
     *
     * @return boolean
     * @throws PropelException
     * @see       DBAdapter::bindValue()
     *
     */
    public function bindValue(PDOStatement $stmt, string $parameter, mixed $value, ColumnMap $cMap, int $position = null): bool
    {
        $pdoType = $cMap->getPdoType();
        // FIXME - This is a temporary hack to get around apparent bugs w/ PDO+MYSQL
        // See http://pecl.php.net/bugs/bug.php?id=9919
        if ($pdoType == PDO::PARAM_BOOL) {
            $value = (int) $value;
            $pdoType = PDO::PARAM_INT;

            return $stmt->bindValue($parameter, $value, $pdoType);
        } elseif ($cMap->isTemporal()) {
            $value = $this->formatTemporalValue($value, $cMap);
        } elseif (is_resource($value) && $cMap->isLob()) {
            // we always need to make sure that the stream is rewound, otherwise nothing will
            // get written to database.
            rewind($value);
        }

        return $stmt->bindValue($parameter, $value, $pdoType);
    }

    /**
     * Prepare connection parameters.
     * See: http://www.propelorm.org/ticket/1360
     *
     * @param array $settings
     *
     * @return array
     *
     * @throws PropelException
     */
    public function prepareParams(array $settings): array
    {
        $settings = parent::prepareParams($settings);
        // Whitelist based on https://bugs.php.net/bug.php?id=47802
        // And https://bugs.php.net/bug.php?id=47802
        $whitelist = array(
            'ASCII',
            'CP1250',
            'CP1251',
            'CP1252',
            'CP1256',
            'CP1257',
            'GREEK',
            'HEBREW',
            'LATIN1',
            'LATIN2',
            'LATIN5',
            'LATIN7',
            'SWE7',
            'UTF8',
            'UTF-8',
        );

        if (isset($settings['settings']['charset']['value'])) {
            if (version_compare(PHP_VERSION, '5.3.6', '<')) {
                $charset = strtoupper($settings['settings']['charset']['value']);

                if (!in_array($charset, $whitelist)) {
                    throw new PropelException(<<<EXCEPTION
Connection option "charset" cannot be used for MySQL connections in PHP versions older than 5.3.6.
    Please refer to http://www.propelorm.org/ticket/1360 for instructions and details about the implications of
    using a SET NAMES statement in the "queries" setting.
EXCEPTION
                );
                }
            } else {
                if (strpos($settings['dsn'], ';charset=') === false) {
                    $settings['dsn'] .= ';charset=' . $settings['settings']['charset']['value'];
                    unset($settings['settings']['charset']);
                }
            }
        }

        return $settings;
    }

    /**
     * Do Explain Plan for query object or query string
     *
     * @param PropelPDO            $con   propel connection
     * @param string|ModelCriteria $query query the criteria or the query string
     *
     * @return PDOStatement    A PDO statement executed using the connection, ready to be fetched
     *@throws PropelException
     */
    public function doExplainPlan(PropelPDO $con, string|ModelCriteria $query): PDOStatement
    {
        if ($query instanceof ModelCriteria) {
            $params = array();
            $dbMap = Propel::getDatabaseMap($query->getDbName());
            $sql = BasePeer::createSelectSql($query, $params);
            $sql = 'EXPLAIN ' . $sql;
        } else {
            $sql = 'EXPLAIN ' . $query;
        }

        $stmt = $con->prepare($sql);

        if ($query instanceof ModelCriteria) {
            $this->bindValues($stmt, $params, $dbMap);
        }

        $stmt->execute();

        return $stmt;
    }
}
