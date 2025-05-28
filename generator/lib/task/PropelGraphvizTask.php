<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */
namespace CK\Generator\Lib\Task;

use CK\Generator\Lib\Util\PropelDotGenerator;
use IOException;
use NullPointerException;
use PhingFile;
/*
require_once 'task/AbstractPropelDataModelTask.php';
require_once 'model/AppData.php';
require_once 'util/PropelDotGenerator.php';
*/

/**
 * A task to generate Graphviz dot files from Propel datamodel.
 *
 * @author     Mark Kimsal
 * @author     Toni Uebernickel <tuebernickel@gmail.com>
 * @version    $Revision$
 * @package    propel.generator.task
 */
class PropelGraphvizTask extends AbstractPropelDataModelTask
{

    /**
     * The properties file that maps an SQL file to a particular database.
     *
     * @var        PhingFile
     */
    private PhingFile $sqldbmap;

    /**
     * Name of the database.
     */
    private string $database;

    /**
     * Name of the output directory.
     */
    private $outDir;

    /**
     * Set the sqldbmap.
     *
     * @param PhingFile $out The db map.
     * @throws IOException
     */
    public function setOutputDirectory(PhingFile $out): void
    {
        if (!$out->exists()) {
            $out->mkdirs();
        }
        $this->outDir = $out;
    }

    /**
     * Set the sqldbmap.
     *
     * @param PhingFile $sqldbmap The db map.
     */
    public function setSqlDbMap(PhingFile $sqldbmap): void
    {
        $this->sqldbmap = $sqldbmap;
    }

    /**
     * Get the sqldbmap.
     *
     * @return PhingFile $sqldbmap.
     */
    public function getSqlDbMap()
    {
        return $this->sqldbmap;
    }

    /**
     * Set the database name.
     *
     * @param string $database
     */
    public function setDatabase(string $database): void
    {
        $this->database = $database;
    }

    /**
     * Get the database name.
     *
     * @return string
     */
    public function getDatabase(): string
    {
        return $this->database;
    }

    public function main(): void
    {
        foreach ($this->getDataModels() as $dataModel) {
            foreach ($dataModel->getDatabases() as $database) {
                $this->log("db: " . $database->getName());
                $this->writeDot(PropelDotGenerator::create($database), $this->outDir, $database->getName());
            }
        }
    }

    /**
     * probably insecure
     */
    public function writeDot($dotSyntax, PhingFile $outputDir, $baseFilename): void
    {
        try {
            $file = new PhingFile($outputDir, $baseFilename . '.schema.dot');
        } catch (IOException|NullPointerException $e) {

        }
        $this->log("Writing dot file to " . $file->getAbsolutePath());
        file_put_contents($file->getAbsolutePath(), $dotSyntax);
    }
}
