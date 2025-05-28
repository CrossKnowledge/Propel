<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */
namespace CK\Runtime\Lib\Adapter;

use CK\Runtime\Lib\Exception\PropelException;
use CK\Runtime\Lib\Propel;
use CK\Runtime\Lib\Connection\PropelPDO;
use CK\Runtime\Lib\Query\Criteria;
use CK\Runtime\Lib\Query\ModelCriteria;
use CK\Runtime\Lib\Util\BasePeer;
use PDO;
use PDOStatement;
/**
 * This is used to connect to PostgresQL databases.
 *
 * <a href="http://www.pgsql.org">http://www.pgsql.org</a>
 *
 * @author     Hans Lellelid <hans@xmpl.org> (Propel)
 * @author     Hakan Tandogan <hakan42@gmx.de> (Torque)
 * @version    $Revision$
 * @package    propel.runtime.adapter
 */
class DBPostgres extends DBAdapter
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
        return "substring($s from $pos" . ($len > -1 ? "for $len" : "") . ")";
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
        return "char_length($s)";
    }

    /**
     * @see       DBAdapter::getIdMethod()
     *
     * @return integer
     */
    protected function getIdMethod(): int
    {
        return DBAdapter::ID_METHOD_SEQUENCE;
    }

    /**
     * Gets ID for specified sequence name.
     * Warning: duplicates logic from PgsqlPlatform::getIdentifierPhp().
     * Any code modification here must be ported there.
     *
     * @param PDO    $con
     * @param string|null $name
     *
     * @return integer
     *
     * @throws PropelException
     */
    public function getId(PDO $con, string $name = null): mixed
    {
        if ($name === null) {
            throw new PropelException("Unable to fetch next sequence ID without sequence name.");
        }
        $stmt = $con->query("SELECT nextval(" . $con->quote($name) . ")");
        $row = $stmt->fetch(PDO::FETCH_NUM);

        return $row[0];
    }

    /**
     * Returns timestamp formatter string for use in date() function.
     *
     * @return string
     */
    public function getTimestampFormatter(): string
    {
        return "Y-m-d H:i:s O";
    }

    /**
     * Returns timestamp formatter string for use in date() function.
     *
     * @return string
     */
    public function getTimeFormatter(): string
    {
        return "H:i:s O";
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
            $sql .= " LIMIT " . $limit;
        }
        if ($offset > 0) {
            $sql .= " OFFSET " . $offset;
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
        return 'random()';
    }

    /**
     * @param Criteria $criteria
     * @param string $tableName
     *
          * @return string
     *@see        DBAdapter::getDeleteFromClause()
     *
     */
    public function getDeleteFromClause(Criteria $criteria, string $tableName): string
    {
        $sql = 'DELETE ';
        if ($queryComment = $criteria->getComment()) {
            $sql .= '/* ' . $queryComment . ' */ ';
        }
        if ($realTableName = $criteria->getTableForAlias($tableName)) {
            if ($this->useQuoteIdentifier()) {
                $realTableName = $this->quoteIdentifierTable($realTableName);
            }
            $sql .= 'FROM ' . $realTableName . ' AS ' . $tableName;
        } else {
            if ($this->useQuoteIdentifier()) {
                $tableName = $this->quoteIdentifierTable($tableName);
            }
            $sql .= 'FROM ' . $tableName;
        }

        return $sql;
    }

    /**
     * @param string $table
     *
     * @return string
     *@see        DBAdapter::quoteIdentifierTable()
     *
     */
    public function quoteIdentifierTable(string $table): string
    {
        // e.g. 'database.table alias' should be escaped as '"database"."table" "alias"'
        return '"' . strtr($table, array('.' => '"."', ' ' => '" "')) . '"';
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
        } else {
            $sql = $query;
        }

        $stmt = $con->prepare($this->getExplainPlanQuery($sql));

        if ($query instanceof ModelCriteria) {
            $this->bindValues($stmt, $params, $dbMap);
        }

        $stmt->execute();

        return $stmt;
    }

    /**
     * Explain Plan compute query getter
     *
     * @param string $query query to explain
     *
     * @return string
     */
    public function getExplainPlanQuery($query)
    {
        return 'EXPLAIN ' . $query;
    }
}
