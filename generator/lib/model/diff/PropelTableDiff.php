<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license     MIT License
 */

namespace CK\Generator\Lib\Model\Diff;
use CK\Generator\Lib\Model\Table;
use CK\Generator\Lib\Model\Column;        // Add this
use CK\Generator\Lib\Model\Index;         // Add this
use CK\Generator\Lib\Model\ForeignKey;

//require_once dirname(__FILE__) . '/../Table.php';
//require_once dirname(__FILE__) . '/PropelColumnDiff.php';

/**
 * Value object for storing Table object diffs
 * Heavily inspired by Doctrine2's Migrations
 * (see http://github.com/doctrine/dbal/tree/master/lib/Doctrine/DBAL/Schema/)
 *
 * @package    propel.generator.model.diff
 */
class PropelTableDiff
{
    protected Table $fromTable;
    protected Table $toTable;

    protected array $addedColumns = array();
    protected array $removedColumns = array();
    protected array $modifiedColumns = array();
    protected array $renamedColumns = array();

    protected array $addedPkColumns = array();
    protected array $removedPkColumns = array();
    protected array $renamedPkColumns = array();

    protected array $addedIndices = array();
    protected array $removedIndices = array();
    protected array $modifiedIndices = array();

    protected array $addedFks = array();
    protected array $removedFks = array();
    protected array $modifiedFks = array();

    /**
     * Setter for the fromTable property
     *
     * @param Table $fromTable
     */
    public function setFromTable(Table $fromTable): void
    {
        $this->fromTable = $fromTable;
    }

    /**
     * Getter for the fromTable property
     *
     * @return Table
     */
    public function getFromTable(): Table
    {
        return $this->fromTable;
    }

    /**
     * Setter for the toTable property
     *
     * @param Table $toTable
     */
    public function setToTable(Table $toTable): void
    {
        $this->toTable = $toTable;
    }

    /**
     * Getter for the toTable property
     *
     * @return Table
     */
    public function getToTable(): Table
    {
        return $this->toTable;
    }

    /**
     * Setter for the addedColumns property
     *
     * @param array $addedColumns
     */
    public function setAddedColumns(array $addedColumns): void
    {
        $this->addedColumns = $addedColumns;
    }

    /**
     * Add an added column
     *
     * @param string $columnName
     * @param Column $addedColumn
     */
    public function addAddedColumn(string $columnName, Column $addedColumn): void
    {
        $this->addedColumns[$columnName] = $addedColumn;
    }

    /**
     * Remove an added column
     *
     * @param string $columnName
     */
    public function removeAddedColumn(string $columnName): void
    {
        unset($this->addedColumns[$columnName]);
    }

    /**
     * Getter for the addedColumns property
     *
     * @return array
     */
    public function getAddedColumns(): array
    {
        return $this->addedColumns;
    }

    /**
     * Get an added column
     *
     * @param string $columnName
     *
     * @return Column
     */
    public function getAddedColumn(string $columnName): Column
    {
        return $this->addedColumns[$columnName];
    }

    /**
     * Setter for the removedColumns property
     *
     * @param array $removedColumns
     */
    public function setRemovedColumns(array $removedColumns): void
    {
        $this->removedColumns = $removedColumns;
    }

    /**
     * Add a removed column
     *
     * @param string $columnName
     * @param Column $removedColumn
     */
    public function addRemovedColumn(string $columnName, Column $removedColumn): void
    {
        $this->removedColumns[$columnName] = $removedColumn;
    }

    /**
     * Remove a removed column
     *
     * @param string $columnName
     */
    public function removeRemovedColumn(string $columnName): void
    {
        unset($this->removedColumns[$columnName]);
    }

    /**
     * Getter for the removedColumns property
     *
     * @return array
     */
    public function getRemovedColumns(): array
    {
        return $this->removedColumns;
    }

    /**
     * Get a removed column
     *
     * @param string $columnName
     *
     * @return Column
     */
    public function getRemovedColumn(string $columnName): Column
    {
        return $this->removedColumns[$columnName];
    }

    /**
     * Setter for the modifiedColumns property
     *
     * @param array $modifiedColumns
     */
    public function setModifiedColumns(array $modifiedColumns): void
    {
        $this->modifiedColumns = $modifiedColumns;
    }

    /**
     * Add a column difference
     *
     * @param string $columnName
     * @param PropelColumnDiff $modifiedColumn
     */
    public function addModifiedColumn(string $columnName, PropelColumnDiff $modifiedColumn): void
    {
        $this->modifiedColumns[$columnName] = $modifiedColumn;
    }

    /**
     * Getter for the modifiedColumns property
     *
     * @return array
     */
    public function getModifiedColumns(): array
    {
        return $this->modifiedColumns;
    }

    /**
     * Setter for the renamedColumns property
     *
     * @param array $renamedColumns
     */
    public function setRenamedColumns(array $renamedColumns): void
    {
        $this->renamedColumns = $renamedColumns;
    }

    /**
     * Add a renamed column
     *
     * @param Column $fromColumn
     * @param Column $toColumn
     */
    public function addRenamedColumn(Column $fromColumn, Column $toColumn): void
    {
        $this->renamedColumns[] = array($fromColumn, $toColumn);
    }

    /**
     * Getter for the renamedColumns property
     *
     * @return array
     */
    public function getRenamedColumns(): array
    {
        return $this->renamedColumns;
    }

    /**
     * Setter for the addedPkColumns property
     *
     * @param  $addedPkColumns
     */
    public function setAddedPkColumns($addedPkColumns): void
    {
        $this->addedPkColumns = $addedPkColumns;
    }

    /**
     * Add an added Pk column
     *
     * @param string $columnName
     * @param Column $addedPkColumn
     */
    public function addAddedPkColumn(string $columnName, Column $addedPkColumn): void
    {
        $this->addedPkColumns[$columnName] = $addedPkColumn;
    }

    /**
     * Remove an added Pk column
     *
     * @param string $columnName
     */
    public function removeAddedPkColumn(string $columnName): void
    {
        unset($this->addedPkColumns[$columnName]);
    }

    /**
     * Getter for the addedPkColumns property
     *
     * @return array
     */
    public function getAddedPkColumns(): array
    {
        return $this->addedPkColumns;
    }

    /**
     * Setter for the removedPkColumns property
     *
     * @param  $removedPkColumns
     */
    public function setRemovedPkColumns($removedPkColumns): void
    {
        $this->removedPkColumns = $removedPkColumns;
    }

    /**
     * Add a removed Pk column
     *
     * @param string $columnName
     * @param Column $removedPkColumn
     */
    public function addRemovedPkColumn(string $columnName, Column $removedPkColumn): void
    {
        $this->removedPkColumns[$columnName] = $removedPkColumn;
    }

    /**
     * Remove a removed Pk column
     *
     * @param string $columnName
     */
    public function removeRemovedPkColumn(string $columnName): void
    {
        unset($this->removedPkColumns[$columnName]);
    }

    /**
     * Getter for the removedPkColumns property
     *
     * @return array
     */
    public function getRemovedPkColumns(): array
    {
        return $this->removedPkColumns;
    }

    /**
     * Setter for the renamedPkColumns property
     *
     * @param $renamedPkColumns
     */
    public function setRenamedPkColumns($renamedPkColumns): void
    {
        $this->renamedPkColumns = $renamedPkColumns;
    }

    /**
     * Add a renamed Pk column
     *
     * @param Column $fromColumn
     * @param Column $toColumn
     */
    public function addRenamedPkColumn(Column $fromColumn, Column $toColumn): void
    {
        $this->renamedPkColumns[] = array($fromColumn, $toColumn);
    }

    /**
     * Getter for the renamedPkColumns property
     *
     * @return array
     */
    public function getRenamedPkColumns(): array
    {
        return $this->renamedPkColumns;
    }

    /**
     * Whether the primary key was modified
     *
     * @return boolean
     */
    public function hasModifiedPk(): bool
    {
        return $this->renamedPkColumns || $this->removedPkColumns || $this->addedPkColumns;
    }

    /**
     * Setter for the addedIndices property
     *
     * @param  $addedIndices
     */
    public function setAddedIndices($addedIndices): void
    {
        $this->addedIndices = $addedIndices;
    }

    /**
     * Add an added Index
     *
     * @param string $indexName
     * @param Index  $addedIndex
     */
    public function addAddedIndex(string $indexName, Index $addedIndex): void
    {
        $this->addedIndices[$indexName] = $addedIndex;
    }

    /**
     * Getter for the addedIndices property
     *
     * @return array
     */
    public function getAddedIndices(): array
    {
        return $this->addedIndices;
    }

    /**
     * Setter for the removedIndices property
     *
     * @param  $removedIndices
     */
    public function setRemovedIndices($removedIndices): void
    {
        $this->removedIndices = $removedIndices;
    }

    /**
     * Add a removed Index
     *
     * @param string $indexName
     * @param Index  $removedIndex
     */
    public function addRemovedIndex(string $indexName, Index $removedIndex): void
    {
        $this->removedIndices[$indexName] = $removedIndex;
    }

    /**
     * Getter for the removedIndices property
     *
     * @return array
     */
    public function getRemovedIndices(): array
    {
        return $this->removedIndices;
    }

    /**
     * Setter for the modifiedIndices property
     *
     * @param  $modifiedIndices
     */
    public function setModifiedIndices($modifiedIndices): void
    {
        $this->modifiedIndices = $modifiedIndices;
    }

    /**
     * Add a modified Index
     *
     * @param string $indexName
     * @param Index  $fromIndex
     * @param Index  $toIndex
     */
    public function addModifiedIndex(string $indexName, Index $fromIndex, Index $toIndex): void
    {
        $this->modifiedIndices[$indexName] = array($fromIndex, $toIndex);
    }

    /**
     * Getter for the modifiedIndices property
     *
     * @return array
     */
    public function getModifiedIndices(): array
    {
        return $this->modifiedIndices;
    }

    /**
     * Setter for the addedFks property
     *
     * @param  $addedFks
     */
    public function setAddedFks($addedFks): void
    {
        $this->addedFks = $addedFks;
    }

    /**
     * Add an added Fk column
     *
     * @param string $fkName
     * @param ForeignKey $addedFk
     */
    public function addAddedFk(string $fkName, ForeignKey $addedFk): void
    {
        $this->addedFks[$fkName] = $addedFk;
    }

    /**
     * Remove an added Fk column
     *
     * @param string $fkName
     */
    public function removeAddedFk(string $fkName): void
    {
        unset($this->addedFks[$fkName]);
    }

    /**
     * Getter for the addedFks property
     *
     * @return array
     */
    public function getAddedFks(): array
    {
        return $this->addedFks;
    }

    /**
     * Setter for the removedFks property
     *
     * @param  $removedFks
     */
    public function setRemovedFks($removedFks): void
    {
        $this->removedFks = $removedFks;
    }

    /**
     * Add a removed Fk column
     *
     * @param string $fkName
     * @param ForeignKey $removedFk
     */
    public function addRemovedFk(string $fkName, ForeignKey $removedFk): void
    {
        $this->removedFks[$fkName] = $removedFk;
    }

    /**
     * Remove a removed Fk column
     *
     * @param string $fkName
     */
    public function removeRemovedFk(string $fkName): void
    {
        unset($this->removedFks[$fkName]);
    }

    /**
     * Getter for the removedFks property
     *
     * @return array
     */
    public function getRemovedFks(): array
    {
        return $this->removedFks;
    }

    /**
     * Setter for the modifiedFks property
     *
     * @param array $modifiedFks
     */
    public function setModifiedFks(array $modifiedFks): void
    {
        $this->modifiedFks = $modifiedFks;
    }

    /**
     * Add a modified Fk
     *
     * @param string $fkName
     * @param ForeignKey $fromFk
     * @param ForeignKey $toFk
     */
    public function addModifiedFk(string $fkName, ForeignKey $fromFk, ForeignKey $toFk): void
    {
        $this->modifiedFks[$fkName] = array($fromFk, $toFk);
    }

    /**
     * Getter for the modifiedFks property
     *
     * @return array
     */
    public function getModifiedFks(): array
    {
        return $this->modifiedFks;
    }

    /**
     * Get the reverse diff for this diff
     *
     * @return PropelTableDiff
     */
    public function getReverseDiff(): PropelTableDiff
    {
        $diff = new self();

        // tables
        $diff->setFromTable($this->getToTable());
        $diff->setToTable($this->getFromTable());

        // columns
        $diff->setAddedColumns($this->getRemovedColumns());
        $diff->setRemovedColumns($this->getAddedColumns());
        $renamedColumns = array();
        foreach ($this->getRenamedColumns() as $columnRenaming) {
            $renamedColumns[] = array_reverse($columnRenaming);
        }
        $diff->setRenamedColumns($renamedColumns);
        $columnDiffs = array();
        foreach ($this->getModifiedColumns() as $name => $columnDiff) {
            $columnDiffs[$name] = $columnDiff->getReverseDiff();
        }
        $diff->setModifiedColumns($columnDiffs);

        // pks
        $diff->setAddedPkColumns($this->getRemovedPkColumns());
        $diff->setRemovedPkColumns($this->getAddedPkColumns());
        $renamedPkColumns = array();
        foreach ($this->getRenamedPkColumns() as $columnRenaming) {
            $renamedPkColumns[] = array_reverse($columnRenaming);
        }
        $diff->setRenamedPkColumns($renamedPkColumns);

        // indices
        $diff->setAddedIndices($this->getRemovedIndices());
        $diff->setRemovedIndices($this->getAddedIndices());
        $indexDiffs = array();
        foreach ($this->getModifiedIndices() as $name => $indexDiff) {
            $indexDiffs[$name] = array_reverse($indexDiff);
        }
        $diff->setModifiedIndices($indexDiffs);

        // fks
        $diff->setAddedFks($this->getRemovedFks());
        $diff->setRemovedFks($this->getAddedFks());
        $fkDiffs = array();
        foreach ($this->getModifiedFks() as $name => $fkDiff) {
            $fkDiffs[$name] = array_reverse($fkDiff);
        }
        $diff->setModifiedFks($fkDiffs);

        return $diff;
    }

    public function __toString()
    {
        $ret = '';
        $ret .= sprintf("  %s:\n", $this->getFromTable()->getName());
        if ($addedColumns = $this->getAddedColumns()) {
            $ret .= "    addedColumns:\n";
            foreach ($addedColumns as $colname => $column) {
                $ret .= sprintf("      - %s\n", $colname);
            }
        }
        if ($removedColumns = $this->getRemovedColumns()) {
            $ret .= "    removedColumns:\n";
            foreach ($removedColumns as $colname => $column) {
                $ret .= sprintf("      - %s\n", $colname);
            }
        }
        if ($modifiedColumns = $this->getModifiedColumns()) {
            $ret .= "    modifiedColumns:\n";
            foreach ($modifiedColumns as $colname => $colDiff) {
                $ret .= $colDiff->__toString();
            }
        }
        if ($renamedColumns = $this->getRenamedColumns()) {
            $ret .= "    renamedColumns:\n";
            foreach ($renamedColumns as $columnRenaming) {
                list($fromColumn, $toColumn) = $columnRenaming;
                $ret .= sprintf("      %s: %s\n", $fromColumn->getName(), $toColumn->getName());
            }
        }
        if ($addedIndices = $this->getAddedIndices()) {
            $ret .= "    addedIndices:\n";
            foreach ($addedIndices as $indexName => $index) {
                $ret .= sprintf("      - %s\n", $indexName);
            }
        }
        if ($removedIndices = $this->getRemovedIndices()) {
            $ret .= "    removedIndices:\n";
            foreach ($removedIndices as $indexName => $index) {
                $ret .= sprintf("      - %s\n", $indexName);
            }
        }
        if ($modifiedIndices = $this->getModifiedIndices()) {
            $ret .= "    modifiedIndices:\n";
            foreach ($modifiedIndices as $indexName => $indexDiff) {
                $ret .= sprintf("      - %s\n", $indexName);
            }
        }
        if ($addedFks = $this->getAddedFks()) {
            $ret .= "    addedFks:\n";
            foreach ($addedFks as $fkName => $fk) {
                $ret .= sprintf("      - %s\n", $fkName);
            }
        }
        if ($removedFks = $this->getRemovedFks()) {
            $ret .= "    removedFks:\n";
            foreach ($removedFks as $fkName => $fk) {
                $ret .= sprintf("      - %s\n", $fkName);
            }
        }
        if ($modifiedFks = $this->getModifiedFks()) {
            $ret .= "    modifiedFks:\n";
            foreach ($modifiedFks as $fkName => $fkFromTo) {
                $ret .= sprintf("      %s:\n", $fkName);
                list($fromFk, $toFk) = $fkFromTo;
                $fromLocalColumns = json_encode($fromFk->getLocalColumns());
                $toLocalColumns = json_encode($toFk->getLocalColumns());
                if ($fromLocalColumns != $toLocalColumns) {
                    $ret .= sprintf("          localColumns: from %s to %s\n", $fromLocalColumns, $toLocalColumns);
                }
                $fromForeignColumns = json_encode($fromFk->getForeignColumns());
                $toForeignColumns = json_encode($toFk->getForeignColumns());
                if ($fromForeignColumns != $toForeignColumns) {
                    $ret .= sprintf("          foreignColumns: from %s to %s\n", $fromForeignColumns, $toForeignColumns);
                }
                if ($fromFk->normalizeFKey($fromFk->getOnUpdate()) != $toFk->normalizeFKey($toFk->getOnUpdate())) {
                    $ret .= sprintf("          onUpdate: from %s to %s\n", $fromFk->getOnUpdate(), $toFk->getOnUpdate());
                }
                if ($fromFk->normalizeFKey($fromFk->getOnDelete()) != $toFk->normalizeFKey($toFk->getOnDelete())) {
                    $ret .= sprintf("          onDelete: from %s to %s\n", $fromFk->getOnDelete(), $toFk->getOnDelete());
                }
            }
        }

        return $ret;
    }
}
