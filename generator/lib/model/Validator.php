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
//require_once dirname(__FILE__) . '/../exception/EngineException.php';
//require_once dirname(__FILE__) . '/PropelTypes.php';
//require_once dirname(__FILE__) . '/Rule.php';

/**
 * Validator.
 *
 * @author     Michael Aichler <aichler@mediacluster.de> (Propel)
 * @version    $Revision$
 * @package    propel.generator.model
 */
class Validator extends XMLElement
{

    const string TRANSLATE_NONE = "none";
    const string TRANSLATE_GETTEXT = "gettext";

    /**
     * The column this validator applies to.
     *
     * @var        Column
     */
    private Column $column;

    /**
     * The rules for the validation.
     *
     * @var        array Rule[]
     */
    private array $ruleList = [];

    /**
     * The translation mode.
     *
     * @var        string
     */
    private string $translate;

    /**
     * Parent table.
     *
     * @var        Table
     */
    private Table $table;

    /**
     * Sets up the Validator object based on the attributes that were passed to loadFromXML().
     *
     * @see        parent::loadFromXML()
     */
    protected function setupObject(): void
    {
        $this->column = $this->getTable()->getColumn($this->getAttribute("column"));
        $this->translate = $this->getAttribute("translate", $this->getTable()->getDatabase()->getDefaultTranslateMethod());;
    }

    /**
     * Add a Rule to this validator.
     * Supports two signatures:
     * - addRule(Rule $rule)
     * - addRule(array $attribs)
     *
     * @param mixed $data Rule object or XML attribs (array) from <rule/> element.
     *
     * @return Rule The added Rule.
     */
    public function addRule(mixed $data): Rule
    {
        if ($data instanceof Rule) {
            $rule = $data; // alias
            $rule->setValidator($this);
            $this->ruleList[] = $rule;

            return $rule;
        } else {
            $rule = new Rule();
            $rule->setValidator($this);
            $rule->loadFromXML($data);

            return $this->addRule($rule); // call self w/ different param
        }
    }

    /**
     * Gets an array of all added rules for this validator.
     *
     * @return array Rule[]
     */
    public function getRules(): array
    {
        return $this->ruleList;
    }

    /**
     * Gets the name of the column that this Validator applies to.
     *
     * @return string
     */
    public function getColumnName(): string
    {
        return $this->column->getName();
    }

    /**
     * Sets the Column object that this validator applies to.
     *
     * @param Column $column
     *
     * @see        Table::addValidator()
     */
    public function setColumn(Column $column): void
    {
        $this->column = $column;
    }

    /**
     * Gets the Column object that this validator applies to.
     *
     * @return Column
     */
    public function getColumn(): Column
    {
        return $this->column;
    }

    /**
     * Set the owning Table.
     *
     * @param Table $table
     */
    public function setTable(Table $table): void
    {
        $this->table = $table;
    }

    /**
     * Get the owning Table.
     *
     * @return Table
     */
    public function getTable(): Table
    {
        return $this->table;
    }

    /**
     * Set the translation mode to use for the message.
     * Currently only "gettext" and "none" are supported.  The default is "none".
     *
     * @param string $method Translation method ("gettext", "none").
     */
    public function setTranslate(string $method): void
    {
        $this->translate = $method;
    }

    /**
     * Get the translation mode to use for the message.
     * Currently only "gettext" and "none" are supported.  The default is "none".
     *
     * @return string Translation method ("gettext", "none").
     */
    public function getTranslate(): string
    {
        return $this->translate;
    }

    /**
     * @throws DOMException
     * @see        XMLElement::appendXml(DOMNode)
     */
    public function appendXml(DOMNode $node)
    {
        $doc = ($node instanceof DOMDocument) ? $node : $node->ownerDocument;

        $valNode = $node->appendChild($doc->createElement('validator'));
        $valNode->setAttribute('column', $this->getColumnName());

        if ($this->translate !== null) {
            $valNode->setAttribute('translate', $this->translate);
        }

        foreach ($this->ruleList as $rule) {
            $rule->appendXml($valNode);
        }
    }
}
