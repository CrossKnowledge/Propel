<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */
namespace CK\Runtime\Lib\Formatter;

use CK\Runtime\Lib\Exception\PropelException;
use CK\Runtime\Lib\OM\BaseObject;
use PDOStatement;

/**
 * statement formatter for Propel query
 * format() returns a PDO statement
 *
 * @author     Francois Zaninotto
 * @version    $Revision$
 * @package    propel.runtime.formatter
 */
class PropelStatementFormatter extends PropelFormatter
{
    public function format(PDOStatement $stmt): PDOStatement
    {
        return $stmt;
    }

    public function formatOne(PDOStatement $stmt): ?PDOStatement
    {
        if ($stmt->rowCount() == 0) {
            return null;
        } else {
            return $stmt;
        }
    }

    /**
     * @throws PropelException
     */
    public function formatRecord(BaseObject $record = null): ?BaseObject
    {
        throw new PropelException('The Statement formatter cannot transform a record into a statement');
    }

    public function isObjectFormatter(): false
    {
        return false;
    }
}
