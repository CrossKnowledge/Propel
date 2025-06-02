<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

namespace CK\Generator\Lib\Model;

use DOMException;
use DOMNode;
use DOMDocument;

//require_once dirname(__FILE__) . '/XMLElement.php';

/**
 * Information related to an ID method.
 *
 * @author     Hans Lellelid <hans@xmpl.org> (Propel)
 * @author     John McNally <jmcnally@collab.net> (Torque)
 * @author     Daniel Rall <dlr@collab.net> (Torque)
 * @version    $Revision$
 * @package    propel.generator.model
 */
class IdMethodParameter extends XMLElement
{

    private $name;
    private $value;

    /**
     * @var Table
     */
    private Table $parentTable;

    /**
     * Sets up the IdMethodParameter object based on the attributes that were passed to loadFromXML().
     *
     * @see        parent::loadFromXML()
     */
    protected function setupObject(): void
    {
        $this->name = $this->getAttribute("name");
        $this->value = $this->getAttribute("value");
    }

    /**
     * Get the parameter name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the parameter name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * Get the parameter value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the parameter value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * Set the parent Table of the id method
     */
    public function setTable(Table $parent): void
    {
        $this->parentTable = $parent;
    }

    /**
     * Get the parent Table of the id method
     */
    public function getTable(): Table
    {
        return $this->parentTable;
    }

    /**
     * Returns the Name of the table the id method is in
     */
    public function getTableName(): ?string
    {
        return $this->parentTable->getName();
    }

    /**
     * @throws DOMException
     * @see        XMLElement::appendXml(DOMNode)
     */
    public function appendXml(DOMNode $node): void
    {
        $doc = ($node instanceof DOMDocument) ? $node : $node->ownerDocument;

        $paramNode = $node->appendChild($doc->createElement('id-method-parameter'));
        if ($this->getName()) {
            $paramNode->setAttribute('name', $this->getName());
        }
        $paramNode->setAttribute('value', $this->getValue());
    }
}
