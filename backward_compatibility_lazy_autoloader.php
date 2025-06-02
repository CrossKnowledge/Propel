<?php
/**
 * Propel Backward Compatibility Lazy Autoloader
 *
 * This autoloader creates aliases for Propel classes on-demand,
 * avoiding PHP warnings for classes that don't exist yet.
 */

class PropelBackwardCompatibilityAutoloader
{
    private static $aliases = [
        'AbstractPropelDataModelTask' => 'CK\\Generator\\Lib\\Task\\AbstractPropelDataModelTask',
        'AbstractPropelTask' => 'CK\\Generator\\Lib\\Task\\AbstractPropelTask',
        'AggregateColumnBehavior' => 'CK\\Generator\\Lib\\Behavior\\AggregateColumnBehavior',
        'AggregateColumnRelationBehavior' => 'CK\\Generator\\Lib\\Behavior\\AggregateColumnRelationBehavior',
        'AlternativeCodingStandardsBehavior' => 'CK\\Generator\\Lib\\Behavior\\AlternativeCodingStandardsBehavior',
        'AppData' => 'CK\\Generator\\Lib\\Model\\AppData',
        'ArchivableBehavior' => 'CK\\Generator\\Lib\\Behavior\\Archivable\\ArchivableBehavior',
        'ArchivableBehaviorObjectBuilderModifier' => 'CK\\Generator\\Lib\\Behavior\\Archivable\\ArchivableBehaviorObjectBuilderModifier',
        'ArchivableBehaviorQueryBuilderModifier' => 'CK\\Generator\\Lib\\Behavior\\Archivable\\ArchivableBehaviorQueryBuilderModifier',
        'AutoAddPkBehavior' => 'CK\\Generator\\Lib\\Behavior\\AutoAddPkBehavior',
        'BaseObject' => 'CK\\Runtime\\Lib\\OM\\BaseObject',
        'BasePeer' => 'CK\\Runtime\\Lib\\Util\\BasePeer',
        'BasePropelMigrationTask' => 'CK\\Generator\\Lib\\Task\\BasePropelMigrationTask',
        'BasicLogger' => 'CK\\Runtime\\Lib\\Logger\\BasicLogger',
        'BasicValidator' => 'CK\\Runtime\\Lib\\Validator\\BasicValidator',
        'Behavior' => 'CK\\Generator\\Lib\\Model\\Behavior',
        'ClassTools' => 'CK\\Generator\\Lib\\Builder\\OM\\ClassTools',
        'Column' => 'CK\\Generator\\Lib\\Model\\Column',
        'ColumnDefaultValue' => 'CK\\Generator\\Lib\\Model\\ColumnDefaultValue',
        'ColumnMap' => 'CK\\Runtime\\Lib\\Map\\ColumnMap',
        'ColumnValue' => 'CK\\Generator\\Lib\\Builder\\Util\\ColumnValue',
        'ConcreteInheritanceBehavior' => 'CK\\Generator\\Lib\\Behavior\\Concrete_Inheritance\\ConcreteInheritanceBehavior',
        'ConcreteInheritanceParentBehavior' => 'CK\\Generator\\Lib\\Behavior\\Concrete_Inheritance\\ConcreteInheritanceParentBehavior',
        'ConstraintNameGenerator' => 'CK\\Generator\\Lib\\Model\\ConstraintNameGenerator',
        'Criteria' => 'CK\\Runtime\\Lib\\Query\\Criteria',
        'Criterion' => 'CK\\Runtime\\Lib\\Query\\Criterion',
        'CriterionIterator' => 'CK\\Runtime\\Lib\\Query\\CriterionIterator',
        'DBAdapter' => 'CK\\Runtime\\Lib\\Adapter\\DBAdapter',
        'DBMSSQL' => 'CK\\Runtime\\Lib\\Adapter\\DBMSSQL',
        'DBMySQL' => 'CK\\Runtime\\Lib\\Adapter\\DBMySQL',
        'DBNone' => 'CK\\Runtime\\Lib\\Adapter\\DBNone',
        'DBOracle' => 'CK\\Runtime\\Lib\\Adapter\\DBOracle',
        'DBPostgres' => 'CK\\Runtime\\Lib\\Adapter\\DBPostgres',
        'DBSQLSRV' => 'CK\\Runtime\\Lib\\Adapter\\DBSQLSRV',
        'DBSQLite' => 'CK\\Runtime\\Lib\\Adapter\\DBSQLite',
        'DataModelBuilder' => 'CK\\Generator\\Lib\\Builder\\DataModelBuilder',
        'DataRow' => 'CK\\Generator\\Lib\\Builder\\Util\\DataRow',
        'DataSQLBuilder' => 'CK\\Generator\\Lib\\Builder\\Sql\\DataSQLBuilder',
        'Database' => 'CK\\Generator\\Lib\\Model\\Database',
        'DatabaseMap' => 'CK\\Runtime\\Lib\\Map\\DatabaseMap',
        'DebugPDO' => 'CK\\Runtime\\Lib\\Connection\\DebugPDO',
        'DebugPDOStatement' => 'CK\\Runtime\\Lib\\Connection\\DebugPDOStatement',
        'DefaultEnglishPluralizer' => 'CK\\Generator\\Lib\\Builder\\Util\\DefaultEnglishPluralizer',
        'DefaultPlatform' => 'CK\\Generator\\Lib\\Platform\\DefaultPlatform',
        'DelegateBehavior' => 'CK\\Generator\\Lib\\Behavior\\DelegateBehavior',
        'Domain' => 'CK\\Generator\\Lib\\Model\\Domain',
        'EngineException' => 'CK\\Generator\\Lib\\Exception\\EngineException',
        'ExtensionQueryBuilder' => 'CK\\Generator\\Lib\\Builder\\OM\\ExtensionQueryBuilder',
        'ExtensionQueryInheritanceBuilder' => 'CK\\Generator\\Lib\\Builder\\OM\\ExtensionQueryInheritanceBuilder',
        'ForeignKey' => 'CK\\Generator\\Lib\\Model\\ForeignKey',
        'GeneratorConfig' => 'CK\\Generator\\Lib\\Config\\GeneratorConfig',
        'GeneratorConfigInterface' => 'CK\\Generator\\Lib\\Config\\GeneratorConfigInterface',
        'I18nBehavior' => 'CK\\Generator\\Lib\\Behavior\\I18nBehavior\\I18nBehavior',
        'I18nBehaviorObjectBuilderModifier' => 'CK\\Generator\\Lib\\Behavior\\I18nBehavior\\I18nBehaviorObjectBuilderModifier',
        'I18nBehaviorPeerBuilderModifier' => 'CK\\Generator\\Lib\\Behavior\\I18nBehavior\\I18nBehaviorPeerBuilderModifier',
        'I18nBehaviorQueryBuilderModifier' => 'CK\\Generator\\Lib\\Behavior\\I18nBehavior\\I18nBehaviorQueryBuilderModifier',
        'IDMethod' => 'CK\\Generator\\Lib\\Model\\IDMethod',
        'IdMethodParameter' => 'CK\\Generator\\Lib\\Model\\IdMethodParameter',
        'Index' => 'CK\\Generator\\Lib\\Model\\Index',
        'Inheritance' => 'CK\\Generator\\Lib\\Model\\Inheritance',
        'Join' => 'CK\\Runtime\\Lib\\Query\\Join',
        'MatchValidator' => 'CK\\Runtime\\Lib\\Validator\\MatchValidator',
        'MaxLengthValidator' => 'CK\\Runtime\\Lib\\Validator\\MaxLengthValidator',
        'MaxValueValidator' => 'CK\\Runtime\\Lib\\Validator\\MaxValueValidator',
        'MinLengthValidator' => 'CK\\Runtime\\Lib\\Validator\\MinLengthValidator',
        'MinValueValidator' => 'CK\\Runtime\\Lib\\Validator\\MinValueValidator',
        'ModelCriteria' => 'CK\\Runtime\\Lib\\Query\\ModelCriteria',
        'ModelCriterion' => 'CK\\Runtime\\Lib\\Query\\ModelCriterion',
        'ModelJoin' => 'CK\\Runtime\\Lib\\Query\\ModelJoin',
        'ModelWith' => 'CK\\Runtime\\Lib\\Formatter\\ModelWith',
        'MojaviLogAdapter' => 'CK\\Runtime\\Lib\\Logger\\MojaviLogAdapter',
        'MssqlDataSQLBuilder' => 'CK\\Generator\\Lib\\Builder\\Sql\\MssqlDataSQLBuilder',
        'MssqlDebugPDO' => 'CK\\Runtime\\Lib\\Adapter\\MSSQL\\MssqlDebugPDO',
        'MssqlPlatform' => 'CK\\Generator\\Lib\\Platform\\MssqlPlatform',
        'MssqlPropelPDO' => 'CK\\Runtime\\Lib\\Adapter\\MSSQL\\MssqlPropelPDO',
        'MysqlDataSQLBuilder' => 'CK\\Generator\\Lib\\Builder\\Sql\\MysqlDataSQLBuilder',
        'MysqlPlatform' => 'CK\\Generator\\Lib\\Platform\\MysqlPlatform',
        'NameFactory' => 'CK\\Generator\\Lib\\Model\\NameFactory',
        'NameGenerator' => 'CK\\Generator\\Lib\\Model\\NameGenerator',
        'NestedSetBehavior' => 'CK\\Generator\\LibBehavior\\NestedSet\\NestedSetBehavior',
        'NestedSetBehaviorObjectBuilderModifier' => 'CK\\Generator\\LibBehavior\\NestedSet\\NestedSetBehaviorObjectBuilderModifier',
        'NestedSetBehaviorPeerBuilderModifier' => 'CK\\Generator\\LibBehavior\\NestedSet\\NestedSetBehaviorPeerBuilderModifier',
        'NestedSetBehaviorQueryBuilderModifier' => 'CK\\Generator\\LibBehavior\\NestedSet\\NestedSetBehaviorQueryBuilderModifier',
        'NestedSetRecursiveIterator' => 'CK\\Runtime\\Lib\\OM\\NestedSetRecursiveIterator',
        'NodeObject' => 'CK\\Runtime\\Lib\\OM\\NodeObject',
        'NodePeer' => 'CK\\Runtime\\Lib\\Util\\NodePeer',
        'NotMatchValidator' => 'CK\\Runtime\\Lib\\Validator\\NotMatchValidator',
        'OMBuilder' => 'CK\\Generator\\Lib\\Builder\\OM\\OMBuilder',
        'ObjectBuilder' => 'CK\\Generator\\Lib\\Builder\\OM\\ObjectBuilder',
        'OracleDataSQLBuilder' => 'CK\\Generator\\Lib\\Builder\\Sql\\OracleDataSQLBuilder',
        'OraclePlatform' => 'CK\\Generator\\Lib\\Platform\\OraclePlatform',
        'PHP5ExtensionNodeBuilder' => 'CK\\Generator\\Lib\\Builder\\OM\\PHP5ExtensionNodeBuilder',
        'PHP5ExtensionNodePeerBuilder' => 'CK\\Generator\\Lib\\Builder\\OM\\PHP5ExtensionNodePeerBuilder',
        'PHP5ExtensionObjectBuilder' => 'CK\\Generator\\Lib\\Builder\\OM\\PHP5ExtensionObjectBuilder',
        'PHP5ExtensionPeerBuilder' => 'CK\\Generator\\Lib\\Builder\\OM\\PHP5ExtensionPeerBuilder',
        'PHP5InterfaceBuilder' => 'CK\\Generator\\Lib\\Builder\\OM\\PHP5InterfaceBuilder',
        'PHP5MultiExtendObjectBuilder' => 'CK\\Generator\\Lib\\Builder\\OM\\PHP5MultiExtendObjectBuilder',
        'PHP5NestedSetBuilder' => 'CK\\Generator\\Lib\\Builder\\OM\\PHP5NestedSetBuilder',
        'PHP5NestedSetPeerBuilder' => 'CK\\Generator\\Lib\\Builder\\OM\\PHP5NestedSetPeerBuilder',
        'PHP5NodeBuilder' => 'CK\\Generator\\Lib\\Builder\\OM\\PHP5NodeBuilder',
        'PHP5NodePeerBuilder' => 'CK\\Generator\\Lib\\Builder\\OM\\PHP5NodePeerBuilder',
        'PHP5ObjectBuilder' => 'CK\\Generator\\Lib\\Builder\\OM\\PHP5ObjectBuilder',
        'PHP5ObjectNoCollectionBuilder' => 'CK\\Generator\\Lib\\Builder\\OM\\PHP5ObjectNoCollectionBuilder',
        'PHP5PeerBuilder' => 'CK\\Generator\\Lib\\Builder\\OM\\PHP5PeerBuilder',
        'PHP5TableMapBuilder' => 'CK\\Generator\\Lib\\Builder\\OM\\PHP5TableMapBuilder',
        'PeerBuilder' => 'CK\\Generator\\Lib\\Builder\\OM\\PeerBuilder',
        'Persistent' => 'CK\\Runtime\\Lib\\OM\\Persistent',
        'PgsqlDataSQLBuilder' => 'CK\\Generator\\Lib\\Builder\\Sql\\PgsqlDataSQLBuilder',
        'PgsqlPlatform' => 'CK\\Generator\\Lib\\Platform\\PgsqlPlatform',
        'PhpNameGenerator' => 'CK\\Generator\\Lib\\Model\\PhpNameGenerator',
        'Pluralizer' => 'CK\\Propel\\Generator\\Lib\\Builder\\Util\\Pluralizer',
        'PreOrderNodeIterator' => 'CK\\Runtime\\Lib\\OM\\PreOrderNodeIterator',
        'Propel' => 'CK\\Runtime\\Lib\\Propel',
        'PropelArrayCollection' => 'CK\\Runtime\\Lib\\Collection\\PropelArrayCollection',
        'PropelArrayFormatter' => 'CK\\Runtime\\Lib\\Formatter\\PropelArrayFormatter',
        'PropelAutoloader' => 'CK\\Runtime\\Lib\\Util\\PropelAutoloader',
        'PropelCSVParser' => 'CK\\Runtime\\Lib\\Parser\\PropelCSVParser',
        'PropelCollection' => 'CK\\Runtime\\Lib\\Collection\\PropelCollection',
        'PropelColumnComparator' => 'CK\\Generator\\Lib\\Model\\Diff\\PropelColumnComparator',
        'PropelColumnDiff' => 'CK\\Generator\\Lib\\Model\\Diff\\PropelColumnDiff',
        'PropelColumnTypes' => 'CK\\Runtime\\Lib\\Util\\PropelColumnTypes',
        'PropelConditionalProxy' => 'CK\\Runtime\\Lib\\Util\\PropelConditionalProxy',
        'PropelConfiguration' => 'CK\\Runtime\\Lib\\Config\\PropelConfiguration',
        'PropelConfigurationIterator' => 'CK\\Runtime\\Lib\\Config\\PropelConfigurationIterator',
        'PropelConvertConfTask' => 'CK\\Generator\\Lib\\Task\\PropelConvertConfTask',
        'PropelDataDumpTask' => 'CK\\Generator\\Lib\\Task\\PropelDataDumpTask',
        'PropelDataSQLTask' => 'CK\\Generator\\Lib\\Task\\PropelDataSQLTask',
        'PropelDatabaseComparator' => 'CK\\Generator\\Lib\\Model\\Diff\\PropelDatabaseComparator',
        'PropelDatabaseDiff' => 'CK\\Generator\\Lib\\Model\\Diff\\PropelDatabaseDiff',
        'PropelDateTime' => 'CK\\Runtime\\Lib\\Util\\PropelDateTime',
        'PropelDotGenerator' => 'CK\\Generator\\Lib\\Util\\PropelDotGenerator',
        'PropelException' => 'CK\\Runtime\\Lib\\Exception\\PropelException',
        'PropelForeignKeyComparator' => 'CK\\Generator\\Lib\\Model\\Diff\\PropelForeignKeyComparator',
        'PropelFormatter' => 'CK\\Runtime\\Lib\\Formatter\\PropelFormatter',
        'PropelGraphvizTask' => 'CK\\Generator\\Lib\\Task\\PropelGraphvizTask',
        'PropelIndexComparator' => 'CK\\Generator\\Lib\\Model\\Diff\\PropelIndexComparator',
        'PropelJSONParser' => 'CK\\Runtime\\Lib\\Parser\\PropelJSONParser',
        'PropelMigrationDownTask' => 'CK\\Generator\\Lib\\Task\\PropelMigrationDownTask',
        'PropelMigrationManager' => 'CK\\Generator\\Lib\\Util\\PropelMigrationManager',
        'PropelMigrationStatusTask' => 'CK\\Generator\\Lib\\Task\\PropelMigrationStatusTask',
        'PropelMigrationTask' => 'CK\\Generator\\Lib\\Task\\PropelMigrationTask',
        'PropelMigrationUpTask' => 'CK\\Generator\\Lib\\Task\\PropelMigrationUpTask',
        'PropelModelPager' => 'CK\\Runtime\\Lib\\Util\\PropelModelPager',
        'PropelOMTask' => 'CK\\Generator\\Lib\\Task\\PropelOMTask',
        'PropelObjectCollection' => 'CK\\Runtime\\Lib\\Collection\\PropelObjectCollection',
        'PropelObjectFormatter' => 'CK\\Runtime\\Lib\\Formatter\\PropelObjectFormatter',
        'PropelOnDemandCollection' => 'CK\\Runtime\\Lib\\Collection\\PropelOnDemandCollection',
        'PropelOnDemandFormatter' => 'CK\\Runtime\\Lib\\Formatter\\PropelOnDemandFormatter',
        'PropelOnDemandIterator' => 'CK\\Runtime\\Lib\\Collection\\PropelOnDemandIterator',
        'PropelPDO' => 'CK\\Runtime\\Lib\\Connection\\PropelPDO',
        'PropelPHPParser' => 'CK\\Generator\\Lib\\Util\\PropelPHPParser',
        'PropelPager' => 'CK\\Runtime\\Lib\\Util\\PropelPager',
        'PropelParser' => 'CK\\Runtime\\Lib\\Parser\\PropelParser',
        'PropelPlatformInterface' => 'CK\\Generator\\Lib\\Platform\\PropelPlatformInterface',
        'PropelQuery' => 'CK\\Runtime\\Lib\\Query\\PropelQuery',
        'PropelQuickBuilder' => 'CK\\Generator\\Lib\\Util\\PropelQuickBuilder',
        'PropelSQLDiffTask' => 'CK\\Generator\\Lib\\Task\\PropelSQLDiffTask',
        'PropelSQLExec' => 'CK\\Generator\\Lib\\Task\\PropelSQLExec',
        'PropelSQLParser' => 'CK\\Generator\\Lib\\Util\\PropelSQLParser',
        'PropelSQLTask' => 'CK\\Generator\\Lib\\Task\\PropelSQLTask',
        'PropelSchemaReverseTask' => 'CK\\Generator\\Lib\\Task\\PropelSchemaReverseTask',
        'PropelSchemaReverse_ValidatorSet' => 'CK\\Generator\\Lib\\Task\\PropelSchemaReverse_ValidatorSet',
        'PropelSchemaValidator' => 'CK\\Generator\\Lib\\Util\\PropelSchemaValidator',
        'PropelSimpleArrayFormatter' => 'CK\\Runtime\\Lib\\Formatter\\PropelSimpleArrayFormatter',
        'PropelSqlBuildTask' => 'CK\\Generator\\Lib\\Task\\PropelSqlBuildTask',
        'PropelSqlManager' => 'CK\\Generator\\Lib\\Util\\PropelSqlManager',
        'PropelStatementFormatter' => 'CK\\Runtime\\Lib\\Formatter\\PropelStatementFormatter',
        'PropelStringReader' => 'CK\\Generator\\Lib\\Builder\\Util\\PropelStringReader',
        'PropelTableComparator' => 'CK\\Generator\\Lib\\Model\\Diff\\PropelTableComparator',
        'PropelTableDiff' => 'CK\\Generator\\Lib\\Model\\Diff\\PropelTableDiff',
        'PropelTemplate' => 'CK\\Generator\\Lib\\Builder\\Util\\PropelTemplate',
        'PropelTypes' => 'CK\\Generator\\Lib\\Model\\PropelTypes',
        'PropelXMLParser' => 'CK\\Runtime\\Lib\\Parser\\PropelXMLParser',
        'PropelYAMLParser' => 'CK\\Runtime\\Lib\\Parser\\PropelYAMLParser',
        'QueryBuilder' => 'CK\\Generator\\Lib\\Builder\\OM\\QueryBuilder',
        'QueryInheritanceBuilder' => 'CK\\Generator\\Lib\\Builder\\OM\\QueryInheritanceBuilder',
        'QuickGeneratorConfig' => 'CK\\Generator\\Lib\\Config\\QuickGeneratorConfig',
        'RelationMap' => 'CK\\Runtime\\Lib\\Map\\RelationMap',
        'RequiredValidator' => 'CK\\Runtime\\Lib\\Validator\\RequiredValidator',
        'Rule' => 'CK\\Generator\\Lib\\Model\\Rule',
        'SchemaException' => 'CK\\Generator\\Lib\\Exception\\SchemaException',
        'SchemaParser' => 'CK\\Generator\\Lib\\Lib\\Reverse\\SchemaParser',
        'ScopedElement' => 'CK\\Generator\\Lib\\Model\\ScopedElement',
        'SimpleFileLogger' => 'CK\\Runtime\\Lib\\Logger\\SimpleFileLogger',
        'SluggableBehavior' => 'CK\\Generator\\Lib\\Behavior\\Sluggable\\SluggableBehavior',
        'SoftDeleteBehavior' => 'CK\\Generator\\Lib\\Behavior\\SoftDeleteBehavior',
        'SortableBehavior' => 'CK\\Generator\\Lib\\Behavior\\Sortable\\SortableBehavior',
        'SortableBehaviorObjectBuilderModifier' => 'CK\\Generator\\Lib\\Behavior\\Sortable\\SortableBehaviorObjectBuilderModifier',
        'SortableBehaviorPeerBuilderModifier' => 'CK\\Generator\\Lib\\Behavior\\Sortable\\SortableBehaviorPeerBuilderModifier',
        'SortableBehaviorQueryBuilderModifier' => 'CK\\Generator\\Lib\\Behavior\\Sortable\\SortableBehaviorQueryBuilderModifier',
        'SortableRelationBehavior' => 'CK\\Generator\\Lib\\Behavior\\Sortable\\SortableRelationBehavior',
        'SqliteDataSQLBuilder' => 'CK\\Generator\\Lib\\Builder\\Sql\\SqliteDataSQLBuilder',
        'SqlitePlatform' => 'CK\\Generator\\Lib\\Platform\\SqlitePlatform',
        'SqlsrvPlatform' => 'CK\\Generator\\Lib\\Platform\\SqlsrvPlatform',
        'StandardEnglishPluralizer' => 'CK\\Generator\\Lib\\Builder\\Util\\StandardEnglishPluralizer',
        'Table' => 'CK\\Generator\\Lib\\Model\\Table',
        'TableMap' => 'CK\\Runtime\\Lib\\Map\\TableMap',
        'TimestampableBehavior' => 'CK\\Generator\\Lib\\Behavior\\TimestampableBehavior',
        'TypeValidator' => 'CK\\Runtime\\Lib\\Validator\\TypeValidator',
        'Unique' => 'CK\\Generator\\Lib\\Model\\Unique',
        'UniqueValidator' => 'CK\\Runtime\\Lib\\Validator\\UniqueValidator',
        'ValidValuesValidator' => 'CK\\Runtime\\Lib\\Validator\\ValidValuesValidator',
        'ValidationFailed' => 'CK\\Runtime\\Lib\\Validator\\ValidationFailed',
        'Validator' => 'CK\\Generator\\Lib\\Model\\Validator',
        'ValidatorMap' => 'CK\\Runtime\\Lib\\Map\\ValidatorMap',
        'VendorInfo' => 'CK\\Generator\\Lib\\Model\\VendorInfo',
        'VersionableBehavior' => 'CK\\Generator\\Lib\\Behavior\\Versionable\\VersionableBehavior',
        'VersionableBehaviorObjectBuilderModifier' => 'CK\\Generator\\Lib\\Behavior\\Versionable\\VersionableBehaviorObjectBuilderModifier',
        'VersionableBehaviorPeerBuilderModifier' => 'CK\\Generator\\Lib\\Behavior\\Versionable\\VersionableBehaviorPeerBuilderModifier',
        'VersionableBehaviorQueryBuilderModifier' => 'CK\\Generator\\Lib\\Behavior\\Versionable\\VersionableBehaviorQueryBuilderModifier',
        'XMLElement' => 'CK\\Generator\\Lib\\Model\\XMLElement',
        'XmlToDataSQL' => 'CK\\Generator\\Lib\\Builder\\Util\\XmlToDataSQL',
        'sfYaml' => 'CK\\Runtime\\Lib\\Parser\\YAML\\sfYaml',
        'sfYamlDumper' => 'CK\\Runtime\\Lib\\Parser\\YAML\\sfYamlDumper',
        'sfYamlInline' => 'CK\\Runtime\\Lib\\Parser\\YAML\\sfYamlInline',
        'sfYamlParser' => 'CK\\Runtime\\Lib\\Parser\\YAML\\sfYamlParser',
    ];

    /**
     * Register the autoloader
     */
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload'], true, true);
    }

    /**
     * Autoload function that creates aliases for Propel classes
     *
     * @param string $className
     * @return bool
     */
    public static function autoload($className)
    {
        // Only handle classes in our alias map
        if (!isset(self::$aliases[$className])) {
            return false;
        }

        $namespacedClass = self::$aliases[$className];

        // Check if the namespaced class exists
        if (class_exists($namespacedClass, true) || interface_exists($namespacedClass, true) || trait_exists($namespacedClass, true)) {
            // Create the alias
            if (class_exists($namespacedClass, false)) {
                class_alias($namespacedClass, $className);
                return true;
            } elseif (interface_exists($namespacedClass, false)) {
                class_alias($namespacedClass, $className);
                return true;
            } elseif (trait_exists($namespacedClass, false)) {
                class_alias($namespacedClass, $className);
                return true;
            }
        }

        return false;
    }

    /**
     * Add more aliases dynamically
     *
     * @param array $aliases
     */
    public static function addAliases(array $aliases)
    {
        self::$aliases = array_merge(self::$aliases, $aliases);
    }

    /**
     * Get all registered aliases
     *
     * @return array
     */
    public static function getAliases()
    {
        return self::$aliases;
    }
}