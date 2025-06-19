<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */
namespace CK\Runtime\Lib\Validator;


/**
 * Simple class that serves as a container for any information about a failed validation.
 *
 * Currently, this class stores the qualified column name (e.g. tablename.COLUMN_NAME) and
 * the message that should be displayed to the user.
 *
 * An array of these objects will be returned by BasePeer::doValidate() if validation
 * failed.
 *
 * @author     Hans Lellelid <hans@xmpl.org>
 * @version    $Revision$
 * @package    propel.runtime.validator
 * @see        BasePeer::doValidate()
 */
class ValidationFailed
{
    /** Column name in tablename.COLUMN_NAME format */
    private string $colname;

    /** Message to display to user. */
    private string $message;

    /** Validator object that caused this to fail. */
    private ?object $validator;

    /**
     * Construct a new ValidationFailed object.
     *
     * @param string $colname   Column name.
     * @param string $message   Message to display to user.
     * @param object|null $validator The Validator that caused this column to fail.
     */
    public function __construct(string $colname, string $message, ?object $validator = null)
    {
        $this->colname = $colname;
        $this->message = $message;
        $this->validator = $validator;
    }

    /**
     * Set the column name.
     *
     * @param string $v
     */
    public function setColumn(string $v): void
    {
        $this->colname = $v;
    }

    /**
     * Gets the column name.
     *
     * @return string Qualified column name (tablename.COLUMN_NAME)
     */
    public function getColumn(): string
    {
        return $this->colname;
    }

    /**
     * Set the message for the validation failure.
     *
     * @param string $v
     */
    public function setMessage(string $v): void
    {
        $this->message = $v;
    }

    /**
     * Gets the message for the validation failure.
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Set the validator object that caused this to fail.
     *
     * @param object $v
     */
    public function setValidator(object $v): void
    {
        $this->validator = $v;
    }

    /**
     * Gets the validator object that caused this to fail.
     *
     * @return object|null
     */
    public function getValidator(): ?object
    {
        return $this->validator;
    }

    /**
     * "magic" method to get string representation of object.
     * Maybe someday PHP5 will support the invoking this method automatically
     * on (string) cast.  Until then, it's pretty useless.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getMessage();
    }
}
