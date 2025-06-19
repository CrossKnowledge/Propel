<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */
namespace CK\Runtime\Lib\Query;

use CK\Runtime\Lib\Propel;
use Exception;
use CK\Runtime\Lib\Adapter\DBAdapter;
use CK\Runtime\Lib\Exception\PropelException;
use CK\Runtime\Lib\Adapter\DBPostgres;

/**
 * This is an "inner" class that describes an object in the criteria.
 *
 * In Torque this is an inner class of the Criteria class.
 *
 * @author     Hans Lellelid <hans@xmpl.org> (Propel)
 * @version    $Revision$
 * @package    propel.runtime.query
 */
class Criterion
{

    const string UND = " AND ";
    const string ODER = " OR ";

    /** Value of the CO. */
    protected mixed $value;

    /** Comparison value.
     *
     * @var string
     */
    protected string $comparison;

    /** Table name. */
    protected ?string $table;

    /** Real table name */
    protected $realtable;

    /** Column name. */
    protected string $column;

    /**
     * Binding type to be used for Criteria::RAW comparison
     *
     * @var string any of the PDO::PARAM_ constant values
     */
    protected $type;

    /** flag to ignore case in comparison */
    protected bool $ignoreStringCase = false;

    /**
     * The DBAdaptor which might be used to get db specific
     * variations of sql.
     */
    protected DBAdapter $db;

    /**
     * other connected criteria and their conjunctions.
     *
     * @var Criterion[]
     */
    protected $clauses = array();
    protected array $conjunctions = array();

    /** "Parent" Criteria class */
    protected $parent;

    /**
     * Create a new instance.
     *
     * @param Criteria $outer      The outer class (this is an "inner" class).
     * @param string $column     TABLE.COLUMN format.
     * @param mixed    $value
     * @param string|null $comparison
     * @param string|null $type
     */
    public function __construct(Criteria $outer, string $column, mixed $value, string $comparison = null, string $type = null)
    {
        $this->value = $value;
        $dotPos = strrpos($column, '.');
        if ($dotPos === false || $comparison == Criteria::RAW) {
            // no dot => aliased column
            $this->table = null;
            $this->column = $column;
        } else {
            $this->table = substr($column, 0, $dotPos);
            $this->column = substr($column, $dotPos + 1);
        }
        $this->comparison = ($comparison === null) ? Criteria::EQUAL : $comparison;
        $this->type = $type;
        $this->init($outer);
    }

    /**
     * Init some properties with the help of outer class
     *
     * @param Criteria $criteria The outer class
     */
    public function init(Criteria $criteria): void
    {
        // init $this->db
        try {
            $db = Propel::getDB($criteria->getDbName());
            $this->setDB($db);
        } catch (Exception) { //Since $e isn't used, we omitted it.
            // we are only doing this to allow easier debugging, so
            // no need to throw up the exception, just make note of it.
            Propel::log("Could not get a DBAdapter, sql may be wrong", Propel::LOG_ERR);
        }

        // init $this->realtable
        $realtable = $criteria->getTableForAlias($this->table);
        $this->realtable = $realtable ?: $this->table;
    }

    /**
     * Get the column name.
     *
     * @return string A String with the column name.
     */
    public function getColumn(): string
    {
        return $this->column;
    }

    /**
     * Set the table name.
     *
     * @param string $name A String with the table name.
     *
     * @return void
     */
    public function setTable($name): void
    {
        $this->table = $name;
    }

    /**
     * Get the table name.
     *
     * @return ?string A String with the table name.
     */
    public function getTable(): ?string
    {
        return $this->table;
    }

    /**
     * Get the comparison.
     *
     * @return string A String with the comparison.
     */
    public function getComparison(): string
    {
        return $this->comparison;
    }

    /**
     * Get the value.
     *
     * @return mixed An Object with the value.
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * Get the value of db.
     * The DBAdapter which might be used to get db specific
     * variations of sql.
     *
     * @return DBAdapter value of db.
     */
    public function getDB(): DBAdapter
    {
        return $this->db;
    }

    /**
     * Set the value of db.
     * The DBAdapter might be used to get db specific variations of sql.
     *
     * @param DBAdapter $v Value to assign to db.
     *
     * @return void
     */
    public function setDB(DBAdapter $v): void
    {
        $this->db = $v;
        foreach ($this->clauses as $clause) {
            $clause->setDB($v);
        }
    }

    /**
     * Sets ignore case.
     *
     * @param boolean $b True if case should be ignored.
     *
     * @return Criterion A modified Criterion object.
     */
    public function setIgnoreCase(bool $b): static
    {
        $this->ignoreStringCase = $b;

        return $this;
    }

    /**
     * Is ignore case on or off?
     *
     * @return boolean True if case is ignored.
     */
    public function isIgnoreCase(): bool
    {
        return $this->ignoreStringCase;
    }

    /**
     * Get the list of clauses in this Criterion.
     *
     * @return array
     */
    protected function getClauses(): array
    {
        return $this->clauses;
    }

    /**
     * Get the list of conjunctions in this Criterion
     *
     * @return array
     */
    public function getConjunctions(): array
    {
        return $this->conjunctions;
    }

    /**
     * Append an AND Criterion onto this Criterion's list.
     */
    public function addAnd(Criterion $criterion): static
    {
        $this->clauses[] = $criterion;
        $this->conjunctions[] = self::UND;

        return $this;
    }

    /**
     * Append an OR Criterion onto this Criterion's list.
     *
     * @param Criterion $criterion
     *
     * @return Criterion
     */
    public function addOr(Criterion $criterion): static
    {
        $this->clauses[] = $criterion;
        $this->conjunctions[] = self::ODER;

        return $this;
    }

    /**
     * Appends a Prepared Statement representation of the Criterion
     * onto the buffer.
     *
     * @param string &$sb    The string that will receive the Prepared Statement
     * @param array  $params A list to which Prepared Statement parameters will be appended
     *
     * @return void
     * @throws PropelException - if the expression builder cannot figure out how to turn a specified
     *                           expression into proper SQL.
     */
    public function appendPsTo(&$sb, array &$params): void
    {
        $sb .= str_repeat('(', count($this->clauses));

        $this->dispatchPsHandling($sb, $params);

        foreach ($this->clauses as $key => $clause) {
            $sb .= $this->conjunctions[$key];
            $clause->appendPsTo($sb, $params);
            $sb .= ')';
        }
    }

    /**
     * Figure out which Criterion method to use
     * to build the prepared statement and parameters using to the Criterion comparison
     * and call it to append the prepared statement and the parameters of the current clause
     *
     * @param string &$sb The string that will receive the Prepared Statement
     * @param array $params A list to which Prepared Statement parameters will be appended
     * @throws PropelException
     */
    protected function dispatchPsHandling(string &$sb, array &$params): void
    {
        switch ($this->comparison) {
            case Criteria::CUSTOM:
                // custom expression with no parameter binding
                $this->appendCustomToPs($sb, $params);
                break;
            case Criteria::RAW:
                // custom expression with a typed parameter binding
                $this->appendRawToPs($sb, $params);
                break;
            case Criteria::IN:
            case Criteria::NOT_IN:
                // table.column IN (?, ?) or table.column NOT IN (?, ?)
                $this->appendInToPs($sb, $params);
                break;
            case Criteria::LIKE:
            case Criteria::NOT_LIKE:
            case Criteria::ILIKE:
            case Criteria::NOT_ILIKE:
                // table.column LIKE ? or table.column NOT LIKE ?  (or ILIKE for Postgres)
                $this->appendLikeToPs($sb, $params);
                break;
            default:
                // table.column = ? or table.column >= ? etc. (traditional expressions, the default)
                $this->appendBasicToPs($sb, $params);
        }
    }

    /**
     * Appends a Prepared Statement representation of the Criterion onto the buffer
     * For custom expressions with no binding, e.g. 'NOW() = 1'
     *
     * @param string &$sb    The string that will receive the Prepared Statement
     * @param array  $params A list to which Prepared Statement parameters will be appended
     */
    protected function appendCustomToPs(string &$sb, array &$params): void
    {
        if ($this->value !== "") {
            $sb .= (string) $this->value;
        }
    }

    /**
     * Appends a Prepared Statement representation of the Criterion onto the buffer
     * For custom expressions with a typed binding, e.g. 'foobar = ?'
     *
     * @param string &$sb    The string that will receive the Prepared Statement
     * @param array  $params A list to which Prepared Statement parameters will be appended
     *
     * @throws PropelException
     */
    protected function appendRawToPs(string &$sb, array &$params): void
    {
        if (substr_count($this->column, '?') != 1) {
            throw new PropelException(sprintf('Could not build SQL for expression "%s" because Criteria::RAW works only with a clause containing a single question mark placeholder', $this->column));
        }
        $params[] = array('table' => null, 'type' => $this->type, 'value' => $this->value);
        $sb .= str_replace('?', ':p' . count($params), $this->column);
    }

    /**
     * Appends a Prepared Statement representation of the Criterion onto the buffer
     * For IN expressions, e.g. table.column IN (?, ?) or table.column NOT IN (?, ?)
     *
     * @param string &$sb    The string that will receive the Prepared Statement
     * @param array  $params A list to which Prepared Statement parameters will be appended
     */
    protected function appendInToPs(string &$sb, array &$params): void
    {
        if ($this->value !== "") {
            $bindParams = array();
            $index = count($params); // to avoid counting the number of parameters for each element in the array
            foreach ((array) $this->value as $value) {
                $params[] = array('table' => $this->realtable, 'column' => $this->column, 'value' => $value);
                $index++; // increment this first to correct for wanting bind params to start with :p1
                $bindParams[] = ':p' . $index;
            }
            if (count($bindParams)) {
                $field = ($this->table === null) ? $this->column : $this->table . '.' . $this->column;
                $sb .= $field . $this->comparison . '(' . implode(',', $bindParams) . ')';
            } else {
                $sb .= ($this->comparison === Criteria::IN) ? "1<>1" : "1=1";
            }
        }
    }

    /**
     * Appends a Prepared Statement representation of the Criterion onto the buffer
     * For LIKE expressions, e.g. table.column LIKE ? or table.column NOT LIKE ?  (or ILIKE for Postgres)
     *
     * @param string &$sb    The string that will receive the Prepared Statement
     * @param array  $params A list to which Prepared Statement parameters will be appended
     */
    protected function appendLikeToPs(&$sb, array &$params): void
    {
        $field = ($this->table === null) ? $this->column : $this->table . '.' . $this->column;
        $db = $this->getDb();
        // If selection is case insensitive use ILIKE for PostgreSQL or SQL
        // UPPER() function on column name for other databases.
        if ($this->ignoreStringCase) {
            if ($db instanceof DBPostgres) {
                if ($this->comparison === Criteria::LIKE) {
                    $this->comparison = Criteria::ILIKE;
                } elseif ($this->comparison === Criteria::NOT_LIKE) {
                    $this->comparison = Criteria::NOT_ILIKE;
                }
            } else {
                $field = $db->ignoreCase($field);
            }
        }

        $params[] = array('table' => $this->realtable, 'column' => $this->column, 'value' => $this->value);

        $sb .= $field . $this->comparison;

        // If selection is case insensitive use SQL UPPER() function
        // on criteria or, if Postgres we are using ILIKE, so not necessary.
        if ($this->ignoreStringCase && !($db instanceof DBPostgres)) {
            $sb .= $db->ignoreCase(':p' . count($params));
        } else {
            $sb .= ':p' . count($params);
        }
    }

    /**
     * Appends a Prepared Statement representation of the Criterion onto the buffer
     * For traditional expressions, e.g. table.column = ? or table.column >= ? etc.
     *
     * @param string &$sb    The string that will receive the Prepared Statement
     * @param array  $params A list to which Prepared Statement parameters will be appended
     *
     * @throws PropelException
     */
    protected function appendBasicToPs(string &$sb, array &$params): void
    {
        $field = ($this->table === null) ? $this->column : $this->table . '.' . $this->column;
        // NULL VALUES need special treatment because the SQL syntax is different
        // i.e. table.column IS NULL rather than table.column = null
        if ($this->value !== null) {

            // ANSI SQL functions get inserted right into SQL (not escaped, etc.)
            if ($this->value === Criteria::CURRENT_DATE || $this->value === Criteria::CURRENT_TIME || $this->value === Criteria::CURRENT_TIMESTAMP) {
                $sb .= $field . $this->comparison . $this->value;
            } else {

                $params[] = array('table' => $this->realtable, 'column' => $this->column, 'value' => $this->value);

                // default case, it is a normal col = value expression; value
                // will be replaced w/ '?' and will be inserted later using PDO bindValue()
                if ($this->ignoreStringCase) {
                    $sb .= $this->getDb()->ignoreCase($field) . $this->comparison . $this->getDb()->ignoreCase(':p' . count($params));
                } else {
                    $sb .= $field . $this->comparison . ':p' . count($params);
                }
            }
        } else {

            // value is null, which means it was either not specified or specifically
            // set to null.
            if ($this->comparison === Criteria::EQUAL || $this->comparison === Criteria::ISNULL) {
                $sb .= $field . Criteria::ISNULL;
            } elseif ($this->comparison === Criteria::NOT_EQUAL || $this->comparison === Criteria::ISNOTNULL) {
                $sb .= $field . Criteria::ISNOTNULL;
            } else {
                // for now throw an exception, because not sure how to interpret this
                throw new PropelException("Could not build SQL for expression: $field " . $this->comparison . " NULL");
            }
        }
    }

    /**
     * This method checks another Criteria to see if they contain
     * the same attributes and hashtable entries.
     *
     * @param Criterion|null $obj
     *
     * @return bool|int|string
     */
    public function equals(?Criterion $obj): bool|int|string
    {
        // TODO: optimize me with early outs
        if ($this === $obj) {
            return true;
        }

        if (($obj === null) || !($obj instanceof Criterion)) {
            return false;
        }

        $crit = $obj;

        $isEquiv = ( ( ($this->table === null && $crit->getTable() === null)
            || ( $this->table !== null && $this->table === $crit->getTable() )
                          )
            && $this->column === $crit->getColumn()
            && $this->comparison === $crit->getComparison());

        // check chained criterion

        $clausesLength = count($this->clauses);
        $isEquiv &= (count($crit->getClauses()) == $clausesLength);
        $critConjunctions = $crit->getConjunctions();
        $critClauses = $crit->getClauses();
        for ($i = 0; $i < $clausesLength && $isEquiv; $i++) {
            $isEquiv &= ($this->conjunctions[$i] === $critConjunctions[$i]);
            $isEquiv &= ($this->clauses[$i] === $critClauses[$i]);
        }

        if ($isEquiv) {
            $isEquiv &= $this->value === $crit->getValue();
        }

        return $isEquiv;
    }

    /**
     * Returns a hash code value for the object.
     * @throws PropelException
     */
    public function hashCode(): int|string
    {
        $h = crc32(serialize($this->value)) ^ crc32($this->comparison);

        if ($this->table !== null) {
            $h ^= crc32($this->table);
        }

        if ($this->column !== null) {
            $h ^= crc32($this->column);
        }

        foreach ($this->clauses as $clause) {
            // TODO: I KNOW there is a php incompatibility with the following line
            // but I don't remember what it is, someone care to look it up and
            // replace it if it doesn't bother us?
            // $clause->appendPsTo($sb='',$params=array());
            $sb = '';
            $params = array();
            $clause->appendPsTo($sb, $params);
            $h ^= crc32(serialize(array($sb, $params)));
            unset ($sb, $params);
        }

        return $h;
    }

    /**
     * Get all tables from nested criterion objects
     *
     * @return array
     */
    public function getAllTables(): array
    {
        $tables = array();
        $this->addCriterionTable($this, $tables);

        return $tables;
    }

    /**
     * method supporting recursion through all criterions to give
     * us a string array of tables from each criterion
     *
     * @param Criterion $c
     * @param array     &$s
     *
     * @return void
     */
    private function addCriterionTable(Criterion $c, array &$s): void
    {
        $s[] = $c->getTable();
        foreach ($c->getClauses() as $clause) {
            $this->addCriterionTable($clause, $s);
        }
    }

    /**
     * get an array of all criterion attached to this
     * recursing through all sub criterion
     *
     * @return Criterion[]
     */
    public function getAttachedCriterion()
    {
        $criterions = array($this);
        foreach ($this->getClauses() as $criterion) {
            /* @ var $criterion Criterion */
            $criterions = array_merge($criterions, $criterion->getAttachedCriterion());
        }

        return $criterions;
    }

    /**
     * Ensures deep cloning of attached objects
     */
    public function __clone()
    {
        foreach ($this->clauses as $key => $criterion) {
            $this->clauses[$key] = clone $criterion;
        }
    }
}
