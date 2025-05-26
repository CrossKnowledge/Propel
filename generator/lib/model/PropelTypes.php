<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

namespace CK\Generator\Lib\Model;

/**
 * A class that maps PropelTypes to PHP native types, PDO types (and Creole types).
 *
 * @author     Hans Lellelid <hans@xmpl.org> (Propel)
 * @version    $Revision$
 * @package    propel.generator.model
 */
class PropelTypes
{

    const string CHAR = "CHAR";
    const string VARCHAR = "VARCHAR";
    const string LONGVARCHAR = "LONGVARCHAR";
    const string CLOB = "CLOB";
    const string CLOB_EMU = "CLOB_EMU";
    const string NUMERIC = "NUMERIC";
    const string DECIMAL = "DECIMAL";
    const string TINYINT = "TINYINT";
    const string SMALLINT = "SMALLINT";
    const string INTEGER = "INTEGER";
    const string BIGINT = "BIGINT";
    const string REAL = "REAL";
    const string FLOAT = "FLOAT";
    const string DOUBLE = "DOUBLE";
    const string BINARY = "BINARY";
    const string VARBINARY = "VARBINARY";
    const string LONGVARBINARY = "LONGVARBINARY";
    const string BLOB = "BLOB";
    const string DATE = "DATE";
    const string TIME = "TIME";
    const string TIMESTAMP = "TIMESTAMP";
    const string BU_DATE = "BU_DATE";
    const string BU_TIMESTAMP = "BU_TIMESTAMP";
    const string BOOLEAN = "BOOLEAN";
    const string BOOLEAN_EMU = "BOOLEAN_EMU";
    const string OBJECT = "OBJECT";
    const string PHP_ARRAY = "ARRAY";
    const string ENUM = "ENUM";

    private static array $TEXT_TYPES = array(
        self::CHAR, self::VARCHAR, self::LONGVARCHAR, self::CLOB, self::DATE, self::TIME, self::TIMESTAMP, self::BU_DATE, self::BU_TIMESTAMP
    );

    private static array $LOB_TYPES = array(
        self::VARBINARY, self::LONGVARBINARY, self::BLOB
    );

    private static array $TEMPORAL_TYPES = array(
        self::DATE, self::TIME, self::TIMESTAMP, self::BU_DATE, self::BU_TIMESTAMP
    );

    private static array $NUMERIC_TYPES = array(
        self::SMALLINT, self::TINYINT, self::INTEGER, self::BIGINT, self::FLOAT, self::DOUBLE, self::NUMERIC, self::DECIMAL, self::REAL
    );

    private static array $BOOLEAN_TYPES = array(
        self::BOOLEAN, self::BOOLEAN_EMU
    );

    const string CHAR_NATIVE_TYPE = "string";
    const string VARCHAR_NATIVE_TYPE = "string";
    const string LONGVARCHAR_NATIVE_TYPE = "string";
    const string CLOB_NATIVE_TYPE = "string";
    const string CLOB_EMU_NATIVE_TYPE = "resource";
    const string NUMERIC_NATIVE_TYPE = "string";
    const string DECIMAL_NATIVE_TYPE = "string";
    const string TINYINT_NATIVE_TYPE = "int";
    const string SMALLINT_NATIVE_TYPE = "int";
    const string INTEGER_NATIVE_TYPE = "int";
    const string BIGINT_NATIVE_TYPE = "string";
    const string REAL_NATIVE_TYPE = "double";
    const string FLOAT_NATIVE_TYPE = "double";
    const string DOUBLE_NATIVE_TYPE = "double";
    const string BINARY_NATIVE_TYPE = "string";
    const string VARBINARY_NATIVE_TYPE = "string";
    const string LONGVARBINARY_NATIVE_TYPE = "string";
    const string BLOB_NATIVE_TYPE = "resource";
    const string BU_DATE_NATIVE_TYPE = "string";
    const string DATE_NATIVE_TYPE = "string";
    const string TIME_NATIVE_TYPE = "string";
    const string TIMESTAMP_NATIVE_TYPE = "string";
    const string BU_TIMESTAMP_NATIVE_TYPE = "string";
    const string BOOLEAN_NATIVE_TYPE = "boolean";
    const string BOOLEAN_EMU_NATIVE_TYPE = "boolean";
    const string OBJECT_NATIVE_TYPE = "";
    const string PHP_ARRAY_NATIVE_TYPE = "array";
    const string ENUM_NATIVE_TYPE = "int";

    /**
     * Mapping between Propel types and PHP native types.
     *
     * @var        array
     */
    private static array $propelToPHPNativeMap = array(
            self::CHAR => self::CHAR_NATIVE_TYPE,
            self::VARCHAR => self::VARCHAR_NATIVE_TYPE,
            self::LONGVARCHAR => self::LONGVARCHAR_NATIVE_TYPE,
            self::CLOB => self::CLOB_NATIVE_TYPE,
            self::CLOB_EMU => self::CLOB_EMU_NATIVE_TYPE,
            self::NUMERIC => self::NUMERIC_NATIVE_TYPE,
            self::DECIMAL => self::DECIMAL_NATIVE_TYPE,
            self::TINYINT => self::TINYINT_NATIVE_TYPE,
            self::SMALLINT => self::SMALLINT_NATIVE_TYPE,
            self::INTEGER => self::INTEGER_NATIVE_TYPE,
            self::BIGINT => self::BIGINT_NATIVE_TYPE,
            self::REAL => self::REAL_NATIVE_TYPE,
            self::FLOAT => self::FLOAT_NATIVE_TYPE,
            self::DOUBLE => self::DOUBLE_NATIVE_TYPE,
            self::BINARY => self::BINARY_NATIVE_TYPE,
            self::VARBINARY => self::VARBINARY_NATIVE_TYPE,
            self::LONGVARBINARY => self::LONGVARBINARY_NATIVE_TYPE,
            self::BLOB => self::BLOB_NATIVE_TYPE,
            self::DATE => self::DATE_NATIVE_TYPE,
            self::BU_DATE => self::BU_DATE_NATIVE_TYPE,
            self::TIME => self::TIME_NATIVE_TYPE,
            self::TIMESTAMP => self::TIMESTAMP_NATIVE_TYPE,
            self::BU_TIMESTAMP => self::BU_TIMESTAMP_NATIVE_TYPE,
            self::BOOLEAN => self::BOOLEAN_NATIVE_TYPE,
            self::BOOLEAN_EMU => self::BOOLEAN_EMU_NATIVE_TYPE,
            self::OBJECT => self::OBJECT_NATIVE_TYPE,
            self::PHP_ARRAY => self::PHP_ARRAY_NATIVE_TYPE,
            self::ENUM => self::ENUM_NATIVE_TYPE,
    );

    /**
     * Mapping between Propel types and Creole types (for rev-eng task)
     *
     * @var        array
     */
    private static array $propelTypeToCreoleTypeMap = array(

            self::CHAR => self::CHAR,
            self::VARCHAR => self::VARCHAR,
            self::LONGVARCHAR => self::LONGVARCHAR,
            self::CLOB => self::CLOB,
            self::NUMERIC => self::NUMERIC,
            self::DECIMAL => self::DECIMAL,
            self::TINYINT => self::TINYINT,
            self::SMALLINT => self::SMALLINT,
            self::INTEGER => self::INTEGER,
            self::BIGINT => self::BIGINT,
            self::REAL => self::REAL,
            self::FLOAT => self::FLOAT,
            self::DOUBLE => self::DOUBLE,
            self::BINARY => self::BINARY,
            self::VARBINARY => self::VARBINARY,
            self::LONGVARBINARY => self::LONGVARBINARY,
            self::BLOB => self::BLOB,
            self::DATE => self::DATE,
            self::TIME => self::TIME,
            self::TIMESTAMP => self::TIMESTAMP,
            self::BOOLEAN => self::BOOLEAN,
            self::BOOLEAN_EMU => self::BOOLEAN_EMU,
            self::OBJECT => self::OBJECT,
            self::PHP_ARRAY => self::PHP_ARRAY,
            self::ENUM => self::ENUM,
            // These are pre-epoch dates, which we need to map to String type
            // since they cannot be properly handled using strtotime() -- or even numeric
            // timestamps on Windows.
            self::BU_DATE => self::VARCHAR,
            self::BU_TIMESTAMP => self::VARCHAR,

    );

    /**
     * Mapping between Propel types and PDO type constants (for prepared statement setting).
     *
     * @var        array
     */
    private static array $propelTypeToPDOTypeMap = array(
            self::CHAR => PDO::PARAM_STR,
            self::VARCHAR => PDO::PARAM_STR,
            self::LONGVARCHAR => PDO::PARAM_STR,
            self::CLOB => PDO::PARAM_STR,
            self::CLOB_EMU => PDO::PARAM_STR,
            self::NUMERIC => PDO::PARAM_INT,
            self::DECIMAL => PDO::PARAM_STR,
            self::TINYINT => PDO::PARAM_INT,
            self::SMALLINT => PDO::PARAM_INT,
            self::INTEGER => PDO::PARAM_INT,
            self::BIGINT => PDO::PARAM_STR,
            self::REAL => PDO::PARAM_STR,
            self::FLOAT => PDO::PARAM_STR,
            self::DOUBLE => PDO::PARAM_STR,
            self::BINARY => PDO::PARAM_STR,
            self::VARBINARY => PDO::PARAM_LOB,
            self::LONGVARBINARY => PDO::PARAM_LOB,
            self::BLOB => PDO::PARAM_LOB,
            self::DATE => PDO::PARAM_STR,
            self::TIME => PDO::PARAM_STR,
            self::TIMESTAMP => PDO::PARAM_STR,
            self::BOOLEAN => PDO::PARAM_BOOL,
            self::BOOLEAN_EMU => PDO::PARAM_INT,
            self::OBJECT => PDO::PARAM_STR,
            self::PHP_ARRAY => PDO::PARAM_STR,
            self::ENUM => PDO::PARAM_INT,

            // These are pre-epoch dates, which we need to map to String type
            // since they cannot be properly handled using strtotime() -- or even numeric
            // timestamps on Windows.
            self::BU_DATE => PDO::PARAM_STR,
            self::BU_TIMESTAMP => PDO::PARAM_STR,
    );

    private static array $pdoTypeNames = array(
        PDO::PARAM_BOOL => 'PDO::PARAM_BOOL',
        PDO::PARAM_NULL => 'PDO::PARAM_NULL',
        PDO::PARAM_INT  => 'PDO::PARAM_INT',
        PDO::PARAM_STR  => 'PDO::PARAM_STR',
        PDO::PARAM_LOB  => 'PDO::PARAM_LOB',
    );

    /**
     * Return native PHP type which corresponds to the
     * Creole type provided. Use in the base object class generation.
     *
     * @param string $propelType The Propel type name.
     * @return string Name of the native PHP type
     */
    public static function getPhpNative(string $propelType): string
    {
        return self::$propelToPHPNativeMap[$propelType];
    }

    /**
     * Returns the correct Creole type _name_ for propel added types
     *
     * @param string $type the propel added type.
     *
     * @return string Name of the the correct Creole type (e.g. "VARCHAR").
     */
    public static function getCreoleType(string $type): string
    {
        return self::$propelTypeToCreoleTypeMap[$type];
    }

    /**
     * Returns the PDO type (PDO::PARAM_* constant) value.
     *
     * @param $type
     * @return int
     */
    public static function getPDOType($type): int
    {
        return self::$propelTypeToPDOTypeMap[$type];
    }

    /**
     * Returns the PDO type ('PDO::PARAM_*' constant) name.
     *
     * @return string
     */
    public static function getPdoTypeString($type): string
    {
        return self::$pdoTypeNames[self::$propelTypeToPDOTypeMap[$type]];
    }

    /**
     * Returns Propel type constant corresponding to Creole type code.
     * Used but Propel Creole task.
     *
     * This shows as it is not used anywhere on the base code, we still need to define its Return Type, and capture the
     * case when the condition isn't met by returning a NULL;
     *
     * @param int $sqlType The Creole SQL type constant.
     *
     * @return string|null The Propel type to use or NULL if no mapping was found.
     */
    public static function getPropelType(int $sqlType): ?string
    {
        if (isset(self::$creoleToPropelTypeMap[$sqlType])) {
            return self::$creoleToPropelTypeMap[$sqlType];
        }
        return null;
    }

    /**
     * Get array of Propel types.
     *
     * @return string[]
     */
    public static function getPropelTypes()
    {
        return array_keys(self::$propelTypeToCreoleTypeMap);
    }

    /**
     * Whether passed type is a temporal (date/time/timestamp) type.
     *
     * @param string $type Propel type
     *
     * @return boolean
     */
    public static function isTemporalType(string $type): bool
    {
        return in_array($type, self::$TEMPORAL_TYPES);
    }

    /**
     * Returns true if values for the type need to be quoted.
     *
     * @param string $type The Propel type to check.
     *
     * @return boolean True if values for the type need to be quoted.
     */
    public static function isTextType(string $type): bool
    {
        return in_array($type, self::$TEXT_TYPES);
    }

    /**
     * Returns true if values for the type are numeric.
     *
     * @param string $type The Propel type to check.
     *
     * @return boolean True if values for the type need to be quoted.
     */
    public static function isNumericType(string $type): bool
    {
        return in_array($type, self::$NUMERIC_TYPES);
    }

    /**
     * Returns true if values for the type are boolean.
     *
     * @param string $type The Propel type to check.
     *
     * @return boolean True if values for the type need to be quoted.
     */
    public static function isBooleanType($type)
    {
        return in_array($type, self::$BOOLEAN_TYPES);
    }

    /**
     * Returns true if type is a LOB type (i.e. would be handled by Blob/Clob class).
     *
     * @param string $type Propel type to check.
     *
     * @return boolean
     */
    public static function isLobType(string $type): bool
    {
        return in_array($type, self::$LOB_TYPES);
    }

    /**
     * Convenience method to indicate whether a passed-in PHP type is a primitive.
     *
     * @param string $phpType The PHP type to check
     *
     * @return boolean Whether the PHP type is a primitive (string, int, boolean, float)
     */
    public static function isPhpPrimitiveType(string $phpType): bool
    {
        return in_array($phpType, array("boolean", "int", "double", "float", "string"));
    }

    /**
     * Convenience method to indicate whether a passed-in PHP type is a numeric primitive.
     *
     * @param string $phpType The PHP type to check
     *
     * @return boolean Whether the PHP type is a primitive (string, int, boolean, float)
     */
    public static function isPhpPrimitiveNumericType(string $phpType): bool
    {
        return in_array($phpType, array("boolean", "int", "double", "float"));
    }

    /**
     * Convenience method to indicate whether a passed-in PHP type is an object.
     *
     * @param string $phpType The PHP type to check
     *
     * @return boolean
     */
    public static function isPhpObjectType(string $phpType): bool
    {
        return (!self::isPhpPrimitiveType($phpType) && !in_array($phpType, array("resource", "array")));
    }

    /**
     * Convenience method to indicate whether a passed-in PHP type is an array.
     *
     * @param string $phpType The PHP type to check
     *
     * @return boolean
     */
    public static function isPhpArrayType(string $phpType): bool
    {
        return strtoupper($phpType) === self::PHP_ARRAY;
    }
}
