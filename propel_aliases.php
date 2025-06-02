<?php
/**
 * Propel Backward Compatibility Class Aliases
 * Generated on: 2025-06-02 08:46:57
 * 
 * This file provides backward compatibility by creating aliases
 * for namespaced Propel classes to their original global names.
 */

if (!class_exists('AbstractPropelDataModelTask') && !interface_exists('AbstractPropelDataModelTask') && !trait_exists('AbstractPropelDataModelTask')) {
    class_alias('CK\Generator\Lib\Task\AbstractPropelDataModelTask', 'AbstractPropelDataModelTask');
}

if (!class_exists('AbstractPropelTask') && !interface_exists('AbstractPropelTask') && !trait_exists('AbstractPropelTask')) {
    class_alias('CK\Generator\Lib\Task\AbstractPropelTask', 'AbstractPropelTask');
}

if (!class_exists('AggregateColumnBehavior') && !interface_exists('AggregateColumnBehavior') && !trait_exists('AggregateColumnBehavior')) {
    class_alias('CK\Generator\Lib\Behavior\AggregateColumnBehavior', 'AggregateColumnBehavior');
}

if (!class_exists('AggregateColumnRelationBehavior') && !interface_exists('AggregateColumnRelationBehavior') && !trait_exists('AggregateColumnRelationBehavior')) {
    class_alias('CK\Generator\Lib\Behavior\AggregateColumnRelationBehavior', 'AggregateColumnRelationBehavior');
}

if (!class_exists('AlternativeCodingStandardsBehavior') && !interface_exists('AlternativeCodingStandardsBehavior') && !trait_exists('AlternativeCodingStandardsBehavior')) {
    class_alias('CK\Generator\Lib\Behavior\AlternativeCodingStandardsBehavior', 'AlternativeCodingStandardsBehavior');
}

if (!class_exists('AppData') && !interface_exists('AppData') && !trait_exists('AppData')) {
    class_alias('CK\Generator\Lib\Model\AppData', 'AppData');
}

if (!class_exists('ArchivableBehavior') && !interface_exists('ArchivableBehavior') && !trait_exists('ArchivableBehavior')) {
    class_alias('CK\Generator\Lib\Behavior\Archivable\ArchivableBehavior', 'ArchivableBehavior');
}

if (!class_exists('ArchivableBehaviorObjectBuilderModifier') && !interface_exists('ArchivableBehaviorObjectBuilderModifier') && !trait_exists('ArchivableBehaviorObjectBuilderModifier')) {
    class_alias('CK\Generator\Lib\Behavior\Archivable\ArchivableBehaviorObjectBuilderModifier', 'ArchivableBehaviorObjectBuilderModifier');
}

if (!class_exists('ArchivableBehaviorQueryBuilderModifier') && !interface_exists('ArchivableBehaviorQueryBuilderModifier') && !trait_exists('ArchivableBehaviorQueryBuilderModifier')) {
    class_alias('CK\Generator\Lib\Behavior\Archivable\ArchivableBehaviorQueryBuilderModifier', 'ArchivableBehaviorQueryBuilderModifier');
}

if (!class_exists('AutoAddPkBehavior') && !interface_exists('AutoAddPkBehavior') && !trait_exists('AutoAddPkBehavior')) {
    class_alias('CK\Generator\Lib\Behavior\AutoAddPkBehavior', 'AutoAddPkBehavior');
}

if (!class_exists('BaseObject') && !interface_exists('BaseObject') && !trait_exists('BaseObject')) {
    class_alias('CK\Runtime\Lib\OM\BaseObject', 'BaseObject');
}

if (!class_exists('BasePeer') && !interface_exists('BasePeer') && !trait_exists('BasePeer')) {
    class_alias('CK\Runtime\Lib\Util\BasePeer', 'BasePeer');
}

if (!class_exists('BasePropelMigrationTask') && !interface_exists('BasePropelMigrationTask') && !trait_exists('BasePropelMigrationTask')) {
    class_alias('CK\Generator\Lib\Task\BasePropelMigrationTask', 'BasePropelMigrationTask');
}

if (!class_exists('BasicLogger') && !interface_exists('BasicLogger') && !trait_exists('BasicLogger')) {
    class_alias('CK\Runtime\Lib\Logger\BasicLogger', 'BasicLogger');
}

if (!class_exists('BasicValidator') && !interface_exists('BasicValidator') && !trait_exists('BasicValidator')) {
    class_alias('CK\Runtime\Lib\Validator\BasicValidator', 'BasicValidator');
}

if (!class_exists('Behavior') && !interface_exists('Behavior') && !trait_exists('Behavior')) {
    class_alias('CK\Generator\Lib\Model\Behavior', 'Behavior');
}

if (!class_exists('ClassTools') && !interface_exists('ClassTools') && !trait_exists('ClassTools')) {
    class_alias('CK\Generator\Lib\Builder\OM\ClassTools', 'ClassTools');
}

if (!class_exists('Column') && !interface_exists('Column') && !trait_exists('Column')) {
    class_alias('CK\Generator\Lib\Model\Column', 'Column');
}

if (!class_exists('ColumnDefaultValue') && !interface_exists('ColumnDefaultValue') && !trait_exists('ColumnDefaultValue')) {
    class_alias('CK\Generator\Lib\Model\ColumnDefaultValue', 'ColumnDefaultValue');
}

if (!class_exists('ColumnMap') && !interface_exists('ColumnMap') && !trait_exists('ColumnMap')) {
    class_alias('CK\Runtime\Lib\Map\ColumnMap', 'ColumnMap');
}

if (!class_exists('ColumnValue') && !interface_exists('ColumnValue') && !trait_exists('ColumnValue')) {
    class_alias('CK\Generator\Lib\Builder\Util\ColumnValue', 'ColumnValue');
}

if (!class_exists('ConcreteInheritanceBehavior') && !interface_exists('ConcreteInheritanceBehavior') && !trait_exists('ConcreteInheritanceBehavior')) {
    class_alias('CK\Generator\Lib\Behavior\Concrete_Inheritance\ConcreteInheritanceBehavior', 'ConcreteInheritanceBehavior');
}

if (!class_exists('ConcreteInheritanceParentBehavior') && !interface_exists('ConcreteInheritanceParentBehavior') && !trait_exists('ConcreteInheritanceParentBehavior')) {
    class_alias('CK\Generator\Lib\Behavior\Concrete_Inheritance\ConcreteInheritanceParentBehavior', 'ConcreteInheritanceParentBehavior');
}

if (!class_exists('ConstraintNameGenerator') && !interface_exists('ConstraintNameGenerator') && !trait_exists('ConstraintNameGenerator')) {
    class_alias('CK\Generator\Lib\Model\ConstraintNameGenerator', 'ConstraintNameGenerator');
}

if (!class_exists('Criteria') && !interface_exists('Criteria') && !trait_exists('Criteria')) {
    class_alias('CK\Runtime\Lib\Query\Criteria', 'Criteria');
}

if (!class_exists('Criterion') && !interface_exists('Criterion') && !trait_exists('Criterion')) {
    class_alias('CK\Runtime\Lib\Query\Criterion', 'Criterion');
}

if (!class_exists('CriterionIterator') && !interface_exists('CriterionIterator') && !trait_exists('CriterionIterator')) {
    class_alias('CK\Runtime\Lib\Query\CriterionIterator', 'CriterionIterator');
}

if (!class_exists('DBAdapter') && !interface_exists('DBAdapter') && !trait_exists('DBAdapter')) {
    class_alias('CK\Runtime\Lib\Adapter\DBAdapter', 'DBAdapter');
}

if (!class_exists('DBMSSQL') && !interface_exists('DBMSSQL') && !trait_exists('DBMSSQL')) {
    class_alias('CK\Runtime\Lib\Adapter\DBMSSQL', 'DBMSSQL');
}

if (!class_exists('DBMySQL') && !interface_exists('DBMySQL') && !trait_exists('DBMySQL')) {
    class_alias('CK\Runtime\Lib\Adapter\DBMySQL', 'DBMySQL');
}

if (!class_exists('DBNone') && !interface_exists('DBNone') && !trait_exists('DBNone')) {
    class_alias('CK\Runtime\Lib\Adapter\DBNone', 'DBNone');
}

if (!class_exists('DBOracle') && !interface_exists('DBOracle') && !trait_exists('DBOracle')) {
    class_alias('CK\Runtime\Lib\Adapter\DBOracle', 'DBOracle');
}

if (!class_exists('DBPostgres') && !interface_exists('DBPostgres') && !trait_exists('DBPostgres')) {
    class_alias('CK\Runtime\Lib\Adapter\DBPostgres', 'DBPostgres');
}

if (!class_exists('DBSQLSRV') && !interface_exists('DBSQLSRV') && !trait_exists('DBSQLSRV')) {
    class_alias('CK\Runtime\Lib\Adapter\DBSQLSRV', 'DBSQLSRV');
}

if (!class_exists('DBSQLite') && !interface_exists('DBSQLite') && !trait_exists('DBSQLite')) {
    class_alias('CK\Runtime\Lib\Adapter\DBSQLite', 'DBSQLite');
}

if (!class_exists('DataModelBuilder') && !interface_exists('DataModelBuilder') && !trait_exists('DataModelBuilder')) {
    class_alias('CK\Generator\Lib\Builder\DataModelBuilder', 'DataModelBuilder');
}

if (!class_exists('DataRow') && !interface_exists('DataRow') && !trait_exists('DataRow')) {
    class_alias('CK\Generator\Lib\Builder\Util\DataRow', 'DataRow');
}

if (!class_exists('DataSQLBuilder') && !interface_exists('DataSQLBuilder') && !trait_exists('DataSQLBuilder')) {
    class_alias('CK\Generator\Lib\Builder\Sql\DataSQLBuilder', 'DataSQLBuilder');
}

if (!class_exists('Database') && !interface_exists('Database') && !trait_exists('Database')) {
    class_alias('CK\Generator\Lib\Model\Database', 'Database');
}

if (!class_exists('DatabaseMap') && !interface_exists('DatabaseMap') && !trait_exists('DatabaseMap')) {
    class_alias('CK\Runtime\Lib\Map\DatabaseMap', 'DatabaseMap');
}

if (!class_exists('DebugPDO') && !interface_exists('DebugPDO') && !trait_exists('DebugPDO')) {
    class_alias('CK\Runtime\Lib\Connection\DebugPDO', 'DebugPDO');
}

if (!class_exists('DebugPDOStatement') && !interface_exists('DebugPDOStatement') && !trait_exists('DebugPDOStatement')) {
    class_alias('CK\Runtime\Lib\Connection\DebugPDOStatement', 'DebugPDOStatement');
}

if (!class_exists('DefaultEnglishPluralizer') && !interface_exists('DefaultEnglishPluralizer') && !trait_exists('DefaultEnglishPluralizer')) {
    class_alias('CK\Generator\Lib\Builder\Util\DefaultEnglishPluralizer', 'DefaultEnglishPluralizer');
}

if (!class_exists('DefaultPlatform') && !interface_exists('DefaultPlatform') && !trait_exists('DefaultPlatform')) {
    class_alias('CK\Generator\Lib\Platform\DefaultPlatform', 'DefaultPlatform');
}

if (!class_exists('DelegateBehavior') && !interface_exists('DelegateBehavior') && !trait_exists('DelegateBehavior')) {
    class_alias('CK\Generator\Lib\Behavior\DelegateBehavior', 'DelegateBehavior');
}

if (!class_exists('Domain') && !interface_exists('Domain') && !trait_exists('Domain')) {
    class_alias('CK\Generator\Lib\Model\Domain', 'Domain');
}

if (!class_exists('EngineException') && !interface_exists('EngineException') && !trait_exists('EngineException')) {
    class_alias('CK\Generator\Lib\Exception\EngineException', 'EngineException');
}

if (!class_exists('ExtensionQueryBuilder') && !interface_exists('ExtensionQueryBuilder') && !trait_exists('ExtensionQueryBuilder')) {
    class_alias('CK\Generator\Lib\Builder\OM\ExtensionQueryBuilder', 'ExtensionQueryBuilder');
}

if (!class_exists('ExtensionQueryInheritanceBuilder') && !interface_exists('ExtensionQueryInheritanceBuilder') && !trait_exists('ExtensionQueryInheritanceBuilder')) {
    class_alias('CK\Generator\Lib\Builder\OM\ExtensionQueryInheritanceBuilder', 'ExtensionQueryInheritanceBuilder');
}

if (!class_exists('ForeignKey') && !interface_exists('ForeignKey') && !trait_exists('ForeignKey')) {
    class_alias('CK\Generator\Lib\Model\ForeignKey', 'ForeignKey');
}

if (!class_exists('GeneratorConfig') && !interface_exists('GeneratorConfig') && !trait_exists('GeneratorConfig')) {
    class_alias('CK\Generator\Lib\Config\GeneratorConfig', 'GeneratorConfig');
}

if (!class_exists('GeneratorConfigInterface') && !interface_exists('GeneratorConfigInterface') && !trait_exists('GeneratorConfigInterface')) {
    class_alias('CK\Generator\Lib\Config\GeneratorConfigInterface', 'GeneratorConfigInterface');
}

if (!class_exists('I18nBehavior') && !interface_exists('I18nBehavior') && !trait_exists('I18nBehavior')) {
    class_alias('CK\Generator\Lib\Behavior\I18nBehavior\I18nBehavior', 'I18nBehavior');
}

if (!class_exists('I18nBehaviorObjectBuilderModifier') && !interface_exists('I18nBehaviorObjectBuilderModifier') && !trait_exists('I18nBehaviorObjectBuilderModifier')) {
    class_alias('CK\Generator\Lib\Behavior\I18nBehavior\I18nBehaviorObjectBuilderModifier', 'I18nBehaviorObjectBuilderModifier');
}

if (!class_exists('I18nBehaviorPeerBuilderModifier') && !interface_exists('I18nBehaviorPeerBuilderModifier') && !trait_exists('I18nBehaviorPeerBuilderModifier')) {
    class_alias('CK\Generator\Lib\Behavior\I18nBehavior\I18nBehaviorPeerBuilderModifier', 'I18nBehaviorPeerBuilderModifier');
}

if (!class_exists('I18nBehaviorQueryBuilderModifier') && !interface_exists('I18nBehaviorQueryBuilderModifier') && !trait_exists('I18nBehaviorQueryBuilderModifier')) {
    class_alias('CK\Generator\Lib\Behavior\I18nBehavior\I18nBehaviorQueryBuilderModifier', 'I18nBehaviorQueryBuilderModifier');
}

if (!class_exists('IDMethod') && !interface_exists('IDMethod') && !trait_exists('IDMethod')) {
    class_alias('CK\Generator\Lib\Model\IDMethod', 'IDMethod');
}

if (!class_exists('IdMethodParameter') && !interface_exists('IdMethodParameter') && !trait_exists('IdMethodParameter')) {
    class_alias('CK\Generator\Lib\Model\IdMethodParameter', 'IdMethodParameter');
}

if (!class_exists('Index') && !interface_exists('Index') && !trait_exists('Index')) {
    class_alias('CK\Generator\Lib\Model\Index', 'Index');
}

if (!class_exists('Inheritance') && !interface_exists('Inheritance') && !trait_exists('Inheritance')) {
    class_alias('CK\Generator\Lib\Model\Inheritance', 'Inheritance');
}

if (!class_exists('Join') && !interface_exists('Join') && !trait_exists('Join')) {
    class_alias('CK\Runtime\Lib\Query\Join', 'Join');
}

if (!class_exists('MatchValidator') && !interface_exists('MatchValidator') && !trait_exists('MatchValidator')) {
    class_alias('CK\Runtime\Lib\Validator\MatchValidator', 'MatchValidator');
}

if (!class_exists('MaxLengthValidator') && !interface_exists('MaxLengthValidator') && !trait_exists('MaxLengthValidator')) {
    class_alias('CK\Runtime\Lib\Validator\MaxLengthValidator', 'MaxLengthValidator');
}

if (!class_exists('MaxValueValidator') && !interface_exists('MaxValueValidator') && !trait_exists('MaxValueValidator')) {
    class_alias('CK\Runtime\Lib\Validator\MaxValueValidator', 'MaxValueValidator');
}

if (!class_exists('MinLengthValidator') && !interface_exists('MinLengthValidator') && !trait_exists('MinLengthValidator')) {
    class_alias('CK\Runtime\Lib\Validator\MinLengthValidator', 'MinLengthValidator');
}

if (!class_exists('MinValueValidator') && !interface_exists('MinValueValidator') && !trait_exists('MinValueValidator')) {
    class_alias('CK\Runtime\Lib\Validator\MinValueValidator', 'MinValueValidator');
}

if (!class_exists('ModelCriteria') && !interface_exists('ModelCriteria') && !trait_exists('ModelCriteria')) {
    class_alias('CK\Runtime\Lib\Query\ModelCriteria', 'ModelCriteria');
}

if (!class_exists('ModelCriterion') && !interface_exists('ModelCriterion') && !trait_exists('ModelCriterion')) {
    class_alias('CK\Runtime\Lib\Query\ModelCriterion', 'ModelCriterion');
}

if (!class_exists('ModelJoin') && !interface_exists('ModelJoin') && !trait_exists('ModelJoin')) {
    class_alias('CK\Runtime\Lib\Query\ModelJoin', 'ModelJoin');
}

if (!class_exists('ModelWith') && !interface_exists('ModelWith') && !trait_exists('ModelWith')) {
    class_alias('CK\Runtime\Lib\Formatter\ModelWith', 'ModelWith');
}

if (!class_exists('MojaviLogAdapter') && !interface_exists('MojaviLogAdapter') && !trait_exists('MojaviLogAdapter')) {
    class_alias('CK\Runtime\Lib\Logger\MojaviLogAdapter', 'MojaviLogAdapter');
}

if (!class_exists('MssqlDataSQLBuilder') && !interface_exists('MssqlDataSQLBuilder') && !trait_exists('MssqlDataSQLBuilder')) {
    class_alias('CK\Generator\Lib\Builder\Sql\MssqlDataSQLBuilder', 'MssqlDataSQLBuilder');
}

if (!class_exists('MssqlDebugPDO') && !interface_exists('MssqlDebugPDO') && !trait_exists('MssqlDebugPDO')) {
    class_alias('CK\Runtime\Lib\Adapter\MSSQL\MssqlDebugPDO', 'MssqlDebugPDO');
}

if (!class_exists('MssqlPlatform') && !interface_exists('MssqlPlatform') && !trait_exists('MssqlPlatform')) {
    class_alias('CK\Generator\Lib\Platform\MssqlPlatform', 'MssqlPlatform');
}

if (!class_exists('MssqlPropelPDO') && !interface_exists('MssqlPropelPDO') && !trait_exists('MssqlPropelPDO')) {
    class_alias('CK\Runtime\Lib\Adapter\MSSQL\MssqlPropelPDO', 'MssqlPropelPDO');
}

if (!class_exists('MysqlDataSQLBuilder') && !interface_exists('MysqlDataSQLBuilder') && !trait_exists('MysqlDataSQLBuilder')) {
    class_alias('CK\Generator\Lib\Builder\Sql\MysqlDataSQLBuilder', 'MysqlDataSQLBuilder');
}

if (!class_exists('MysqlPlatform') && !interface_exists('MysqlPlatform') && !trait_exists('MysqlPlatform')) {
    class_alias('CK\Generator\Lib\Platform\MysqlPlatform', 'MysqlPlatform');
}

if (!class_exists('NameFactory') && !interface_exists('NameFactory') && !trait_exists('NameFactory')) {
    class_alias('CK\Generator\Lib\Model\NameFactory', 'NameFactory');
}

if (!class_exists('NameGenerator') && !interface_exists('NameGenerator') && !trait_exists('NameGenerator')) {
    class_alias('CK\Generator\Lib\Model\NameGenerator', 'NameGenerator');
}

if (!class_exists('NestedSetBehavior') && !interface_exists('NestedSetBehavior') && !trait_exists('NestedSetBehavior')) {
    class_alias('CK\Generator\LibBehavior\NestedSet\NestedSetBehavior', 'NestedSetBehavior');
}

if (!class_exists('NestedSetBehaviorObjectBuilderModifier') && !interface_exists('NestedSetBehaviorObjectBuilderModifier') && !trait_exists('NestedSetBehaviorObjectBuilderModifier')) {
    class_alias('CK\Generator\LibBehavior\NestedSet\NestedSetBehaviorObjectBuilderModifier', 'NestedSetBehaviorObjectBuilderModifier');
}

if (!class_exists('NestedSetBehaviorPeerBuilderModifier') && !interface_exists('NestedSetBehaviorPeerBuilderModifier') && !trait_exists('NestedSetBehaviorPeerBuilderModifier')) {
    class_alias('CK\Generator\LibBehavior\NestedSet\NestedSetBehaviorPeerBuilderModifier', 'NestedSetBehaviorPeerBuilderModifier');
}

if (!class_exists('NestedSetBehaviorQueryBuilderModifier') && !interface_exists('NestedSetBehaviorQueryBuilderModifier') && !trait_exists('NestedSetBehaviorQueryBuilderModifier')) {
    class_alias('CK\Generator\LibBehavior\NestedSet\NestedSetBehaviorQueryBuilderModifier', 'NestedSetBehaviorQueryBuilderModifier');
}

if (!class_exists('NestedSetRecursiveIterator') && !interface_exists('NestedSetRecursiveIterator') && !trait_exists('NestedSetRecursiveIterator')) {
    class_alias('CK\Runtime\Lib\OM\NestedSetRecursiveIterator', 'NestedSetRecursiveIterator');
}

if (!class_exists('NodeObject') && !interface_exists('NodeObject') && !trait_exists('NodeObject')) {
    class_alias('CK\Runtime\Lib\OM\NodeObject', 'NodeObject');
}

if (!class_exists('NodePeer') && !interface_exists('NodePeer') && !trait_exists('NodePeer')) {
    class_alias('CK\Runtime\Lib\Util\NodePeer', 'NodePeer');
}

if (!class_exists('NotMatchValidator') && !interface_exists('NotMatchValidator') && !trait_exists('NotMatchValidator')) {
    class_alias('CK\Runtime\Lib\Validator\NotMatchValidator', 'NotMatchValidator');
}

if (!class_exists('OMBuilder') && !interface_exists('OMBuilder') && !trait_exists('OMBuilder')) {
    class_alias('CK\Generator\Lib\Builder\OM\OMBuilder', 'OMBuilder');
}

if (!class_exists('ObjectBuilder') && !interface_exists('ObjectBuilder') && !trait_exists('ObjectBuilder')) {
    class_alias('CK\Generator\Lib\Builder\OM\ObjectBuilder', 'ObjectBuilder');
}

if (!class_exists('OracleDataSQLBuilder') && !interface_exists('OracleDataSQLBuilder') && !trait_exists('OracleDataSQLBuilder')) {
    class_alias('CK\Generator\Lib\Builder\Sql\OracleDataSQLBuilder', 'OracleDataSQLBuilder');
}

if (!class_exists('OraclePlatform') && !interface_exists('OraclePlatform') && !trait_exists('OraclePlatform')) {
    class_alias('CK\Generator\Lib\Platform\OraclePlatform', 'OraclePlatform');
}

if (!class_exists('PHP5ExtensionNodeBuilder') && !interface_exists('PHP5ExtensionNodeBuilder') && !trait_exists('PHP5ExtensionNodeBuilder')) {
    class_alias('CK\Generator\Lib\Builder\OM\PHP5ExtensionNodeBuilder', 'PHP5ExtensionNodeBuilder');
}

if (!class_exists('PHP5ExtensionNodePeerBuilder') && !interface_exists('PHP5ExtensionNodePeerBuilder') && !trait_exists('PHP5ExtensionNodePeerBuilder')) {
    class_alias('CK\Generator\Lib\Builder\OM\PHP5ExtensionNodePeerBuilder', 'PHP5ExtensionNodePeerBuilder');
}

if (!class_exists('PHP5ExtensionObjectBuilder') && !interface_exists('PHP5ExtensionObjectBuilder') && !trait_exists('PHP5ExtensionObjectBuilder')) {
    class_alias('CK\Generator\Lib\Builder\OM\PHP5ExtensionObjectBuilder', 'PHP5ExtensionObjectBuilder');
}

if (!class_exists('PHP5ExtensionPeerBuilder') && !interface_exists('PHP5ExtensionPeerBuilder') && !trait_exists('PHP5ExtensionPeerBuilder')) {
    class_alias('CK\Generator\Lib\Builder\OM\PHP5ExtensionPeerBuilder', 'PHP5ExtensionPeerBuilder');
}

if (!class_exists('PHP5InterfaceBuilder') && !interface_exists('PHP5InterfaceBuilder') && !trait_exists('PHP5InterfaceBuilder')) {
    class_alias('CK\Generator\Lib\Builder\OM\PHP5InterfaceBuilder', 'PHP5InterfaceBuilder');
}

if (!class_exists('PHP5MultiExtendObjectBuilder') && !interface_exists('PHP5MultiExtendObjectBuilder') && !trait_exists('PHP5MultiExtendObjectBuilder')) {
    class_alias('CK\Generator\Lib\Builder\OM\PHP5MultiExtendObjectBuilder', 'PHP5MultiExtendObjectBuilder');
}

if (!class_exists('PHP5NestedSetBuilder') && !interface_exists('PHP5NestedSetBuilder') && !trait_exists('PHP5NestedSetBuilder')) {
    class_alias('CK\Generator\Lib\Builder\OM\PHP5NestedSetBuilder', 'PHP5NestedSetBuilder');
}

if (!class_exists('PHP5NestedSetPeerBuilder') && !interface_exists('PHP5NestedSetPeerBuilder') && !trait_exists('PHP5NestedSetPeerBuilder')) {
    class_alias('CK\Generator\Lib\Builder\OM\PHP5NestedSetPeerBuilder', 'PHP5NestedSetPeerBuilder');
}

if (!class_exists('PHP5NodeBuilder') && !interface_exists('PHP5NodeBuilder') && !trait_exists('PHP5NodeBuilder')) {
    class_alias('CK\Generator\Lib\Builder\OM\PHP5NodeBuilder', 'PHP5NodeBuilder');
}

if (!class_exists('PHP5NodePeerBuilder') && !interface_exists('PHP5NodePeerBuilder') && !trait_exists('PHP5NodePeerBuilder')) {
    class_alias('CK\Generator\Lib\Builder\OM\PHP5NodePeerBuilder', 'PHP5NodePeerBuilder');
}

if (!class_exists('PHP5ObjectBuilder') && !interface_exists('PHP5ObjectBuilder') && !trait_exists('PHP5ObjectBuilder')) {
    class_alias('CK\Generator\Lib\Builder\OM\PHP5ObjectBuilder', 'PHP5ObjectBuilder');
}

if (!class_exists('PHP5ObjectNoCollectionBuilder') && !interface_exists('PHP5ObjectNoCollectionBuilder') && !trait_exists('PHP5ObjectNoCollectionBuilder')) {
    class_alias('CK\Generator\Lib\Builder\OM\PHP5ObjectNoCollectionBuilder', 'PHP5ObjectNoCollectionBuilder');
}

if (!class_exists('PHP5PeerBuilder') && !interface_exists('PHP5PeerBuilder') && !trait_exists('PHP5PeerBuilder')) {
    class_alias('CK\Generator\Lib\Builder\OM\PHP5PeerBuilder', 'PHP5PeerBuilder');
}

if (!class_exists('PHP5TableMapBuilder') && !interface_exists('PHP5TableMapBuilder') && !trait_exists('PHP5TableMapBuilder')) {
    class_alias('CK\Generator\Lib\Builder\OM\PHP5TableMapBuilder', 'PHP5TableMapBuilder');
}

if (!class_exists('PeerBuilder') && !interface_exists('PeerBuilder') && !trait_exists('PeerBuilder')) {
    class_alias('CK\Generator\Lib\Builder\OM\PeerBuilder', 'PeerBuilder');
}

if (!class_exists('Persistent') && !interface_exists('Persistent') && !trait_exists('Persistent')) {
    class_alias('CK\Runtime\Lib\OM\Persistent', 'Persistent');
}

if (!class_exists('PgsqlDataSQLBuilder') && !interface_exists('PgsqlDataSQLBuilder') && !trait_exists('PgsqlDataSQLBuilder')) {
    class_alias('CK\Generator\Lib\Builder\Sql\PgsqlDataSQLBuilder', 'PgsqlDataSQLBuilder');
}

if (!class_exists('PgsqlPlatform') && !interface_exists('PgsqlPlatform') && !trait_exists('PgsqlPlatform')) {
    class_alias('CK\Generator\Lib\Platform\PgsqlPlatform', 'PgsqlPlatform');
}

if (!class_exists('PhpNameGenerator') && !interface_exists('PhpNameGenerator') && !trait_exists('PhpNameGenerator')) {
    class_alias('CK\Generator\Lib\Model\PhpNameGenerator', 'PhpNameGenerator');
}

if (!class_exists('Pluralizer') && !interface_exists('Pluralizer') && !trait_exists('Pluralizer')) {
    class_alias('CK\Propel\Generator\Lib\Builder\Util\Pluralizer', 'Pluralizer');
}

if (!class_exists('PreOrderNodeIterator') && !interface_exists('PreOrderNodeIterator') && !trait_exists('PreOrderNodeIterator')) {
    class_alias('CK\Runtime\Lib\OM\PreOrderNodeIterator', 'PreOrderNodeIterator');
}

if (!class_exists('Propel') && !interface_exists('Propel') && !trait_exists('Propel')) {
    class_alias('CK\Runtime\Lib\Propel', 'Propel');
}

if (!class_exists('PropelArrayCollection') && !interface_exists('PropelArrayCollection') && !trait_exists('PropelArrayCollection')) {
    class_alias('CK\Runtime\Lib\Collection\PropelArrayCollection', 'PropelArrayCollection');
}

if (!class_exists('PropelArrayFormatter') && !interface_exists('PropelArrayFormatter') && !trait_exists('PropelArrayFormatter')) {
    class_alias('CK\Runtime\Lib\Formatter\PropelArrayFormatter', 'PropelArrayFormatter');
}

if (!class_exists('PropelAutoloader') && !interface_exists('PropelAutoloader') && !trait_exists('PropelAutoloader')) {
    class_alias('CK\Runtime\Lib\Util\PropelAutoloader', 'PropelAutoloader');
}

if (!class_exists('PropelCSVParser') && !interface_exists('PropelCSVParser') && !trait_exists('PropelCSVParser')) {
    class_alias('CK\Runtime\Lib\Parser\PropelCSVParser', 'PropelCSVParser');
}

if (!class_exists('PropelCollection') && !interface_exists('PropelCollection') && !trait_exists('PropelCollection')) {
    class_alias('CK\Runtime\Lib\Collection\PropelCollection', 'PropelCollection');
}

if (!class_exists('PropelColumnComparator') && !interface_exists('PropelColumnComparator') && !trait_exists('PropelColumnComparator')) {
    class_alias('CK\Generator\Lib\Model\Diff\PropelColumnComparator', 'PropelColumnComparator');
}

if (!class_exists('PropelColumnDiff') && !interface_exists('PropelColumnDiff') && !trait_exists('PropelColumnDiff')) {
    class_alias('CK\Generator\Lib\Model\Diff\PropelColumnDiff', 'PropelColumnDiff');
}

if (!class_exists('PropelColumnTypes') && !interface_exists('PropelColumnTypes') && !trait_exists('PropelColumnTypes')) {
    class_alias('CK\Runtime\Lib\Util\PropelColumnTypes', 'PropelColumnTypes');
}

if (!class_exists('PropelConditionalProxy') && !interface_exists('PropelConditionalProxy') && !trait_exists('PropelConditionalProxy')) {
    class_alias('CK\Runtime\Lib\Util\PropelConditionalProxy', 'PropelConditionalProxy');
}

if (!class_exists('PropelConfiguration') && !interface_exists('PropelConfiguration') && !trait_exists('PropelConfiguration')) {
    class_alias('CK\Runtime\Lib\Config\PropelConfiguration', 'PropelConfiguration');
}

if (!class_exists('PropelConfigurationIterator') && !interface_exists('PropelConfigurationIterator') && !trait_exists('PropelConfigurationIterator')) {
    class_alias('CK\Runtime\Lib\Config\PropelConfigurationIterator', 'PropelConfigurationIterator');
}

if (!class_exists('PropelConvertConfTask') && !interface_exists('PropelConvertConfTask') && !trait_exists('PropelConvertConfTask')) {
    class_alias('CK\Generator\Lib\Task\PropelConvertConfTask', 'PropelConvertConfTask');
}

if (!class_exists('PropelDataDumpTask') && !interface_exists('PropelDataDumpTask') && !trait_exists('PropelDataDumpTask')) {
    class_alias('CK\Generator\Lib\Task\PropelDataDumpTask', 'PropelDataDumpTask');
}

if (!class_exists('PropelDataSQLTask') && !interface_exists('PropelDataSQLTask') && !trait_exists('PropelDataSQLTask')) {
    class_alias('CK\Generator\Lib\Task\PropelDataSQLTask', 'PropelDataSQLTask');
}

if (!class_exists('PropelDatabaseComparator') && !interface_exists('PropelDatabaseComparator') && !trait_exists('PropelDatabaseComparator')) {
    class_alias('CK\Generator\Lib\Model\Diff\PropelDatabaseComparator', 'PropelDatabaseComparator');
}

if (!class_exists('PropelDatabaseDiff') && !interface_exists('PropelDatabaseDiff') && !trait_exists('PropelDatabaseDiff')) {
    class_alias('CK\Generator\Lib\Model\Diff\PropelDatabaseDiff', 'PropelDatabaseDiff');
}

if (!class_exists('PropelDateTime') && !interface_exists('PropelDateTime') && !trait_exists('PropelDateTime')) {
    class_alias('CK\Runtime\Lib\Util\PropelDateTime', 'PropelDateTime');
}

if (!class_exists('PropelDotGenerator') && !interface_exists('PropelDotGenerator') && !trait_exists('PropelDotGenerator')) {
    class_alias('CK\Generator\Lib\Util\PropelDotGenerator', 'PropelDotGenerator');
}

if (!class_exists('PropelException') && !interface_exists('PropelException') && !trait_exists('PropelException')) {
    class_alias('CK\Runtime\Lib\Exception\PropelException', 'PropelException');
}

if (!class_exists('PropelForeignKeyComparator') && !interface_exists('PropelForeignKeyComparator') && !trait_exists('PropelForeignKeyComparator')) {
    class_alias('CK\Generator\Lib\Model\Diff\PropelForeignKeyComparator', 'PropelForeignKeyComparator');
}

if (!class_exists('PropelFormatter') && !interface_exists('PropelFormatter') && !trait_exists('PropelFormatter')) {
    class_alias('CK\Runtime\Lib\Formatter\PropelFormatter', 'PropelFormatter');
}

if (!class_exists('PropelGraphvizTask') && !interface_exists('PropelGraphvizTask') && !trait_exists('PropelGraphvizTask')) {
    class_alias('CK\Generator\Lib\Task\PropelGraphvizTask', 'PropelGraphvizTask');
}

if (!class_exists('PropelIndexComparator') && !interface_exists('PropelIndexComparator') && !trait_exists('PropelIndexComparator')) {
    class_alias('CK\Generator\Lib\Model\Diff\PropelIndexComparator', 'PropelIndexComparator');
}

if (!class_exists('PropelJSONParser') && !interface_exists('PropelJSONParser') && !trait_exists('PropelJSONParser')) {
    class_alias('CK\Runtime\Lib\Parser\PropelJSONParser', 'PropelJSONParser');
}

if (!class_exists('PropelMigrationDownTask') && !interface_exists('PropelMigrationDownTask') && !trait_exists('PropelMigrationDownTask')) {
    class_alias('CK\Generator\Lib\Task\PropelMigrationDownTask', 'PropelMigrationDownTask');
}

if (!class_exists('PropelMigrationManager') && !interface_exists('PropelMigrationManager') && !trait_exists('PropelMigrationManager')) {
    class_alias('CK\Generator\Lib\Util\PropelMigrationManager', 'PropelMigrationManager');
}

if (!class_exists('PropelMigrationStatusTask') && !interface_exists('PropelMigrationStatusTask') && !trait_exists('PropelMigrationStatusTask')) {
    class_alias('CK\Generator\Lib\Task\PropelMigrationStatusTask', 'PropelMigrationStatusTask');
}

if (!class_exists('PropelMigrationTask') && !interface_exists('PropelMigrationTask') && !trait_exists('PropelMigrationTask')) {
    class_alias('CK\Generator\Lib\Task\PropelMigrationTask', 'PropelMigrationTask');
}

if (!class_exists('PropelMigrationUpTask') && !interface_exists('PropelMigrationUpTask') && !trait_exists('PropelMigrationUpTask')) {
    class_alias('CK\Generator\Lib\Task\PropelMigrationUpTask', 'PropelMigrationUpTask');
}

if (!class_exists('PropelModelPager') && !interface_exists('PropelModelPager') && !trait_exists('PropelModelPager')) {
    class_alias('CK\Runtime\Lib\Util\PropelModelPager', 'PropelModelPager');
}

if (!class_exists('PropelOMTask') && !interface_exists('PropelOMTask') && !trait_exists('PropelOMTask')) {
    class_alias('CK\Generator\Lib\Task\PropelOMTask', 'PropelOMTask');
}

if (!class_exists('PropelObjectCollection') && !interface_exists('PropelObjectCollection') && !trait_exists('PropelObjectCollection')) {
    class_alias('CK\Runtime\Lib\Collection\PropelObjectCollection', 'PropelObjectCollection');
}

if (!class_exists('PropelObjectFormatter') && !interface_exists('PropelObjectFormatter') && !trait_exists('PropelObjectFormatter')) {
    class_alias('CK\Runtime\Lib\Formatter\PropelObjectFormatter', 'PropelObjectFormatter');
}

if (!class_exists('PropelOnDemandCollection') && !interface_exists('PropelOnDemandCollection') && !trait_exists('PropelOnDemandCollection')) {
    class_alias('CK\Runtime\Lib\Collection\PropelOnDemandCollection', 'PropelOnDemandCollection');
}

if (!class_exists('PropelOnDemandFormatter') && !interface_exists('PropelOnDemandFormatter') && !trait_exists('PropelOnDemandFormatter')) {
    class_alias('CK\Runtime\Lib\Formatter\PropelOnDemandFormatter', 'PropelOnDemandFormatter');
}

if (!class_exists('PropelOnDemandIterator') && !interface_exists('PropelOnDemandIterator') && !trait_exists('PropelOnDemandIterator')) {
    class_alias('CK\Runtime\Lib\Collection\PropelOnDemandIterator', 'PropelOnDemandIterator');
}

if (!class_exists('PropelPDO') && !interface_exists('PropelPDO') && !trait_exists('PropelPDO')) {
    class_alias('CK\Runtime\Lib\Connection\PropelPDO', 'PropelPDO');
}

if (!class_exists('PropelPHPParser') && !interface_exists('PropelPHPParser') && !trait_exists('PropelPHPParser')) {
    class_alias('CK\Generator\Lib\Util\PropelPHPParser', 'PropelPHPParser');
}

if (!class_exists('PropelPager') && !interface_exists('PropelPager') && !trait_exists('PropelPager')) {
    class_alias('CK\Runtime\Lib\Util\PropelPager', 'PropelPager');
}

if (!class_exists('PropelParser') && !interface_exists('PropelParser') && !trait_exists('PropelParser')) {
    class_alias('CK\Runtime\Lib\Parser\PropelParser', 'PropelParser');
}

if (!class_exists('PropelPlatformInterface') && !interface_exists('PropelPlatformInterface') && !trait_exists('PropelPlatformInterface')) {
    class_alias('CK\Generator\Lib\Platform\PropelPlatformInterface', 'PropelPlatformInterface');
}

if (!class_exists('PropelQuery') && !interface_exists('PropelQuery') && !trait_exists('PropelQuery')) {
    class_alias('CK\Runtime\Lib\Query\PropelQuery', 'PropelQuery');
}

if (!class_exists('PropelQuickBuilder') && !interface_exists('PropelQuickBuilder') && !trait_exists('PropelQuickBuilder')) {
    class_alias('CK\Generator\Lib\Util\PropelQuickBuilder', 'PropelQuickBuilder');
}

if (!class_exists('PropelSQLDiffTask') && !interface_exists('PropelSQLDiffTask') && !trait_exists('PropelSQLDiffTask')) {
    class_alias('CK\Generator\Lib\Task\PropelSQLDiffTask', 'PropelSQLDiffTask');
}

if (!class_exists('PropelSQLExec') && !interface_exists('PropelSQLExec') && !trait_exists('PropelSQLExec')) {
    class_alias('CK\Generator\Lib\Task\PropelSQLExec', 'PropelSQLExec');
}

if (!class_exists('PropelSQLParser') && !interface_exists('PropelSQLParser') && !trait_exists('PropelSQLParser')) {
    class_alias('CK\Generator\Lib\Util\PropelSQLParser', 'PropelSQLParser');
}

if (!class_exists('PropelSQLTask') && !interface_exists('PropelSQLTask') && !trait_exists('PropelSQLTask')) {
    class_alias('CK\Generator\Lib\Task\PropelSQLTask', 'PropelSQLTask');
}

if (!class_exists('PropelSchemaReverseTask') && !interface_exists('PropelSchemaReverseTask') && !trait_exists('PropelSchemaReverseTask')) {
    class_alias('CK\Generator\Lib\Task\PropelSchemaReverseTask', 'PropelSchemaReverseTask');
}

if (!class_exists('PropelSchemaReverse_ValidatorSet') && !interface_exists('PropelSchemaReverse_ValidatorSet') && !trait_exists('PropelSchemaReverse_ValidatorSet')) {
    class_alias('CK\Generator\Lib\Task\PropelSchemaReverse_ValidatorSet', 'PropelSchemaReverse_ValidatorSet');
}

if (!class_exists('PropelSchemaValidator') && !interface_exists('PropelSchemaValidator') && !trait_exists('PropelSchemaValidator')) {
    class_alias('CK\Generator\Lib\Util\PropelSchemaValidator', 'PropelSchemaValidator');
}

if (!class_exists('PropelSimpleArrayFormatter') && !interface_exists('PropelSimpleArrayFormatter') && !trait_exists('PropelSimpleArrayFormatter')) {
    class_alias('CK\Runtime\Lib\Formatter\PropelSimpleArrayFormatter', 'PropelSimpleArrayFormatter');
}

if (!class_exists('PropelSqlBuildTask') && !interface_exists('PropelSqlBuildTask') && !trait_exists('PropelSqlBuildTask')) {
    class_alias('CK\Generator\Lib\Task\PropelSqlBuildTask', 'PropelSqlBuildTask');
}

if (!class_exists('PropelSqlManager') && !interface_exists('PropelSqlManager') && !trait_exists('PropelSqlManager')) {
    class_alias('CK\Generator\Lib\Util\PropelSqlManager', 'PropelSqlManager');
}

if (!class_exists('PropelStatementFormatter') && !interface_exists('PropelStatementFormatter') && !trait_exists('PropelStatementFormatter')) {
    class_alias('CK\Runtime\Lib\Formatter\PropelStatementFormatter', 'PropelStatementFormatter');
}

if (!class_exists('PropelStringReader') && !interface_exists('PropelStringReader') && !trait_exists('PropelStringReader')) {
    class_alias('CK\Generator\Lib\Builder\Util\PropelStringReader', 'PropelStringReader');
}

if (!class_exists('PropelTableComparator') && !interface_exists('PropelTableComparator') && !trait_exists('PropelTableComparator')) {
    class_alias('CK\Generator\Lib\Model\Diff\PropelTableComparator', 'PropelTableComparator');
}

if (!class_exists('PropelTableDiff') && !interface_exists('PropelTableDiff') && !trait_exists('PropelTableDiff')) {
    class_alias('CK\Generator\Lib\Model\Diff\PropelTableDiff', 'PropelTableDiff');
}

if (!class_exists('PropelTemplate') && !interface_exists('PropelTemplate') && !trait_exists('PropelTemplate')) {
    class_alias('CK\Generator\Lib\Builder\Util\PropelTemplate', 'PropelTemplate');
}

if (!class_exists('PropelTypes') && !interface_exists('PropelTypes') && !trait_exists('PropelTypes')) {
    class_alias('CK\Generator\Lib\Model\PropelTypes', 'PropelTypes');
}

if (!class_exists('PropelXMLParser') && !interface_exists('PropelXMLParser') && !trait_exists('PropelXMLParser')) {
    class_alias('CK\Runtime\Lib\Parser\PropelXMLParser', 'PropelXMLParser');
}

if (!class_exists('PropelYAMLParser') && !interface_exists('PropelYAMLParser') && !trait_exists('PropelYAMLParser')) {
    class_alias('CK\Runtime\Lib\Parser\PropelYAMLParser', 'PropelYAMLParser');
}

if (!class_exists('QueryBuilder') && !interface_exists('QueryBuilder') && !trait_exists('QueryBuilder')) {
    class_alias('CK\Generator\Lib\Builder\OM\QueryBuilder', 'QueryBuilder');
}

if (!class_exists('QueryInheritanceBuilder') && !interface_exists('QueryInheritanceBuilder') && !trait_exists('QueryInheritanceBuilder')) {
    class_alias('CK\Generator\Lib\Builder\OM\QueryInheritanceBuilder', 'QueryInheritanceBuilder');
}

if (!class_exists('QuickGeneratorConfig') && !interface_exists('QuickGeneratorConfig') && !trait_exists('QuickGeneratorConfig')) {
    class_alias('CK\Generator\Lib\Config\QuickGeneratorConfig', 'QuickGeneratorConfig');
}

if (!class_exists('RelationMap') && !interface_exists('RelationMap') && !trait_exists('RelationMap')) {
    class_alias('CK\Runtime\Lib\Map\RelationMap', 'RelationMap');
}

if (!class_exists('RequiredValidator') && !interface_exists('RequiredValidator') && !trait_exists('RequiredValidator')) {
    class_alias('CK\Runtime\Lib\Validator\RequiredValidator', 'RequiredValidator');
}

if (!class_exists('Rule') && !interface_exists('Rule') && !trait_exists('Rule')) {
    class_alias('CK\Generator\Lib\Model\Rule', 'Rule');
}

if (!class_exists('SchemaException') && !interface_exists('SchemaException') && !trait_exists('SchemaException')) {
    class_alias('CK\Generator\Lib\Exception\SchemaException', 'SchemaException');
}

if (!class_exists('SchemaParser') && !interface_exists('SchemaParser') && !trait_exists('SchemaParser')) {
    class_alias('CK\Generator\Lib\Lib\Reverse\SchemaParser', 'SchemaParser');
}

if (!class_exists('ScopedElement') && !interface_exists('ScopedElement') && !trait_exists('ScopedElement')) {
    class_alias('CK\Generator\Lib\Model\ScopedElement', 'ScopedElement');
}

if (!class_exists('SimpleFileLogger') && !interface_exists('SimpleFileLogger') && !trait_exists('SimpleFileLogger')) {
    class_alias('CK\Runtime\Lib\Logger\SimpleFileLogger', 'SimpleFileLogger');
}

if (!class_exists('SluggableBehavior') && !interface_exists('SluggableBehavior') && !trait_exists('SluggableBehavior')) {
    class_alias('CK\Generator\Lib\Behavior\Sluggable\SluggableBehavior', 'SluggableBehavior');
}

if (!class_exists('SoftDeleteBehavior') && !interface_exists('SoftDeleteBehavior') && !trait_exists('SoftDeleteBehavior')) {
    class_alias('CK\Generator\Lib\Behavior\SoftDeleteBehavior', 'SoftDeleteBehavior');
}

if (!class_exists('SortableBehavior') && !interface_exists('SortableBehavior') && !trait_exists('SortableBehavior')) {
    class_alias('CK\Generator\Lib\Behavior\Sortable\SortableBehavior', 'SortableBehavior');
}

if (!class_exists('SortableBehaviorObjectBuilderModifier') && !interface_exists('SortableBehaviorObjectBuilderModifier') && !trait_exists('SortableBehaviorObjectBuilderModifier')) {
    class_alias('CK\Generator\Lib\Behavior\Sortable\SortableBehaviorObjectBuilderModifier', 'SortableBehaviorObjectBuilderModifier');
}

if (!class_exists('SortableBehaviorPeerBuilderModifier') && !interface_exists('SortableBehaviorPeerBuilderModifier') && !trait_exists('SortableBehaviorPeerBuilderModifier')) {
    class_alias('CK\Generator\Lib\Behavior\Sortable\SortableBehaviorPeerBuilderModifier', 'SortableBehaviorPeerBuilderModifier');
}

if (!class_exists('SortableBehaviorQueryBuilderModifier') && !interface_exists('SortableBehaviorQueryBuilderModifier') && !trait_exists('SortableBehaviorQueryBuilderModifier')) {
    class_alias('CK\Generator\Lib\Behavior\Sortable\SortableBehaviorQueryBuilderModifier', 'SortableBehaviorQueryBuilderModifier');
}

if (!class_exists('SortableRelationBehavior') && !interface_exists('SortableRelationBehavior') && !trait_exists('SortableRelationBehavior')) {
    class_alias('CK\Generator\Lib\Behavior\Sortable\SortableRelationBehavior', 'SortableRelationBehavior');
}

if (!class_exists('SqliteDataSQLBuilder') && !interface_exists('SqliteDataSQLBuilder') && !trait_exists('SqliteDataSQLBuilder')) {
    class_alias('CK\Generator\Lib\Builder\Sql\SqliteDataSQLBuilder', 'SqliteDataSQLBuilder');
}

if (!class_exists('SqlitePlatform') && !interface_exists('SqlitePlatform') && !trait_exists('SqlitePlatform')) {
    class_alias('CK\Generator\Lib\Platform\SqlitePlatform', 'SqlitePlatform');
}

if (!class_exists('SqlsrvPlatform') && !interface_exists('SqlsrvPlatform') && !trait_exists('SqlsrvPlatform')) {
    class_alias('CK\Generator\Lib\Platform\SqlsrvPlatform', 'SqlsrvPlatform');
}

if (!class_exists('StandardEnglishPluralizer') && !interface_exists('StandardEnglishPluralizer') && !trait_exists('StandardEnglishPluralizer')) {
    class_alias('CK\Generator\Lib\Builder\Util\StandardEnglishPluralizer', 'StandardEnglishPluralizer');
}

if (!class_exists('Table') && !interface_exists('Table') && !trait_exists('Table')) {
    class_alias('CK\Generator\Lib\Model\Table', 'Table');
}

if (!class_exists('TableMap') && !interface_exists('TableMap') && !trait_exists('TableMap')) {
    class_alias('CK\Runtime\Lib\Map\TableMap', 'TableMap');
}

if (!class_exists('TimestampableBehavior') && !interface_exists('TimestampableBehavior') && !trait_exists('TimestampableBehavior')) {
    class_alias('CK\Generator\Lib\Behavior\TimestampableBehavior', 'TimestampableBehavior');
}

if (!class_exists('TypeValidator') && !interface_exists('TypeValidator') && !trait_exists('TypeValidator')) {
    class_alias('CK\Runtime\Lib\Validator\TypeValidator', 'TypeValidator');
}

if (!class_exists('Unique') && !interface_exists('Unique') && !trait_exists('Unique')) {
    class_alias('CK\Generator\Lib\Model\Unique', 'Unique');
}

if (!class_exists('UniqueValidator') && !interface_exists('UniqueValidator') && !trait_exists('UniqueValidator')) {
    class_alias('CK\Runtime\Lib\Validator\UniqueValidator', 'UniqueValidator');
}

if (!class_exists('ValidValuesValidator') && !interface_exists('ValidValuesValidator') && !trait_exists('ValidValuesValidator')) {
    class_alias('CK\Runtime\Lib\Validator\ValidValuesValidator', 'ValidValuesValidator');
}

if (!class_exists('ValidationFailed') && !interface_exists('ValidationFailed') && !trait_exists('ValidationFailed')) {
    class_alias('CK\Runtime\Lib\Validator\ValidationFailed', 'ValidationFailed');
}

if (!class_exists('Validator') && !interface_exists('Validator') && !trait_exists('Validator')) {
    class_alias('CK\Generator\Lib\Model\Validator', 'Validator');
}

if (!class_exists('ValidatorMap') && !interface_exists('ValidatorMap') && !trait_exists('ValidatorMap')) {
    class_alias('CK\Runtime\Lib\Map\ValidatorMap', 'ValidatorMap');
}

if (!class_exists('VendorInfo') && !interface_exists('VendorInfo') && !trait_exists('VendorInfo')) {
    class_alias('CK\Generator\Lib\Model\VendorInfo', 'VendorInfo');
}

if (!class_exists('VersionableBehavior') && !interface_exists('VersionableBehavior') && !trait_exists('VersionableBehavior')) {
    class_alias('CK\Generator\Lib\Behavior\Versionable\VersionableBehavior', 'VersionableBehavior');
}

if (!class_exists('VersionableBehaviorObjectBuilderModifier') && !interface_exists('VersionableBehaviorObjectBuilderModifier') && !trait_exists('VersionableBehaviorObjectBuilderModifier')) {
    class_alias('CK\Generator\Lib\Behavior\Versionable\VersionableBehaviorObjectBuilderModifier', 'VersionableBehaviorObjectBuilderModifier');
}

if (!class_exists('VersionableBehaviorPeerBuilderModifier') && !interface_exists('VersionableBehaviorPeerBuilderModifier') && !trait_exists('VersionableBehaviorPeerBuilderModifier')) {
    class_alias('CK\Generator\Lib\Behavior\Versionable\VersionableBehaviorPeerBuilderModifier', 'VersionableBehaviorPeerBuilderModifier');
}

if (!class_exists('VersionableBehaviorQueryBuilderModifier') && !interface_exists('VersionableBehaviorQueryBuilderModifier') && !trait_exists('VersionableBehaviorQueryBuilderModifier')) {
    class_alias('CK\Generator\Lib\Behavior\Versionable\VersionableBehaviorQueryBuilderModifier', 'VersionableBehaviorQueryBuilderModifier');
}

if (!class_exists('XMLElement') && !interface_exists('XMLElement') && !trait_exists('XMLElement')) {
    class_alias('CK\Generator\Lib\Model\XMLElement', 'XMLElement');
}

if (!class_exists('XmlToDataSQL') && !interface_exists('XmlToDataSQL') && !trait_exists('XmlToDataSQL')) {
    class_alias('CK\Generator\Lib\Builder\Util\XmlToDataSQL', 'XmlToDataSQL');
}

if (!class_exists('sfYaml') && !interface_exists('sfYaml') && !trait_exists('sfYaml')) {
    class_alias('CK\Runtime\Lib\Parser\YAML\sfYaml', 'sfYaml');
}

if (!class_exists('sfYamlDumper') && !interface_exists('sfYamlDumper') && !trait_exists('sfYamlDumper')) {
    class_alias('CK\Runtime\Lib\Parser\YAML\sfYamlDumper', 'sfYamlDumper');
}

if (!class_exists('sfYamlInline') && !interface_exists('sfYamlInline') && !trait_exists('sfYamlInline')) {
    class_alias('CK\Runtime\Lib\Parser\YAML\sfYamlInline', 'sfYamlInline');
}

if (!class_exists('sfYamlParser') && !interface_exists('sfYamlParser') && !trait_exists('sfYamlParser')) {
    class_alias('CK\Runtime\Lib\Parser\YAML\sfYamlParser', 'sfYamlParser');
}

