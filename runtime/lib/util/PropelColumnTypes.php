<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */
namespace CK\Runtime\Lib\Util;

use PDO;
/**
 * Enumeration of Propel types.
 *
 * THIS CLASS MUST BE KEPT UP-TO-DATE WITH THE MORE EXTENSIVE GENERATOR VERSION OF THIS CLASS.
 *
 * @author     Hans Lellelid <hans@xmpl.org> (Propel)
 * @version    $Revision$
 * @package    propel.runtime.util
 */
class PropelColumnTypes
{

    const
    string ENUM = "ENUM";
    const
    string PHP_ARRAY = "ARRAY";
    const
    string OBJECT = "OBJECT";
    const
    string BOOLEAN_EMU = "BOOLEAN_EMU";
    const
    string BOOLEAN = "BOOLEAN";
    const
    string BU_TIMESTAMP = "BU_TIMESTAMP";
    const
    string BU_DATE = "BU_DATE";
    const
    string TIMESTAMP = "TIMESTAMP";
    const
    string TIME = "TIME";
    const
    string DATE = "DATE";
    const
    string BLOB = "BLOB";
    const
    string LONGVARBINARY = "LONGVARBINARY";
    const
    string VARBINARY = "VARBINARY";
    const
    string BINARY = "BINARY";
    const
    string DOUBLE = "DOUBLE";
    const
    string FLOAT = "FLOAT";
    const
    string REAL = "REAL";
    const
    string BIGINT = "BIGINT";
    const
    string INTEGER = "INTEGER";
    const
    string SMALLINT = "SMALLINT";
    const
    string TINYINT = "TINYINT";
    const
    string DECIMAL = "DECIMAL";
    const
    string NUMERIC = "NUMERIC";
    const
    string CLOB_EMU = "CLOB_EMU";
    const
    string CLOB = "CLOB";
    const
    string LONGVARCHAR = "LONGVARCHAR";
    const
    string VARCHAR = "VARCHAR";
    const
    string CHAR = "CHAR";

    private static array $propelToPdoMap = array(
        self::CHAR        => PDO::PARAM_STR,
        self::VARCHAR     => PDO::PARAM_STR,
        self::LONGVARCHAR => PDO::PARAM_STR,
        self::CLOB        => PDO::PARAM_LOB,
        self::CLOB_EMU    => PDO::PARAM_STR,
        self::NUMERIC     => PDO::PARAM_STR,
        self::DECIMAL     => PDO::PARAM_STR,
        self::TINYINT     => PDO::PARAM_INT,
        self::SMALLINT    => PDO::PARAM_INT,
        self::INTEGER     => PDO::PARAM_INT,
        self::BIGINT      => PDO::PARAM_STR,
        self::REAL        => PDO::PARAM_STR,
        self::FLOAT       => PDO::PARAM_STR,
        self::DOUBLE      => PDO::PARAM_STR,
        self::BINARY      => PDO::PARAM_STR,
        self::VARBINARY   => PDO::PARAM_STR,
        self::LONGVARBINARY => PDO::PARAM_STR,
        self::BLOB        => PDO::PARAM_LOB,
        self::DATE        => PDO::PARAM_STR,
        self::TIME        => PDO::PARAM_STR,
        self::TIMESTAMP   => PDO::PARAM_STR,
        self::BU_DATE     => PDO::PARAM_STR,
        self::BU_TIMESTAMP => PDO::PARAM_STR,
        self::BOOLEAN     => PDO::PARAM_BOOL,
        self::BOOLEAN_EMU => PDO::PARAM_INT,
        self::OBJECT      => PDO::PARAM_STR,
        self::PHP_ARRAY   => PDO::PARAM_STR,
        self::ENUM   => PDO::PARAM_INT,
    );

    /**
     * Returns the PDO type (PDO::PARAM_* constant) value for the Propel type provided.
     *
     * @param string $propelType
     *
     * @return int
     */
    public static function getPdoType(string $propelType): int
    {
        return self::$propelToPdoMap[$propelType];
    }
}
