<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */
namespace CK\Generator\Lib\Model;

//use CK\Generator\Lib\Config\GeneratorConfig;
use DOMNode;
use DOMDocument;
use InvalidArgumentException;

//require_once dirname(__FILE__) . '/VendorInfo.php';

/**
 * An abstract class for elements represented by XML tags (e.g. Column, Table).
 *
 * @author     Hans Lellelid <hans@xmpl.org>
 * @version    $Revision$
 * @package    propel.generator.model
 */
abstract class XMLElement
{

    /**
     * The name => value attributes from XML.
     *
     * @var array
     */
    protected array $attributes = array();

    /**
     * Any associated vendor-specific information objects.
     *
     * @var VendorInfo[]
     */
    protected array $vendorInfos = array();

    /**
     * Replaces the old loadFromXML() so that we can use loadFromXML() to load the attribs into the class.
     */
    abstract protected function setupObject();

    /**
     * This is the entry point method for loading data from XML.
     * It calls a setupObject() method that must be implemented by the child class.
     *
     * @param array $attributes The attributes for the XML tag.
     */
    public function loadFromXML(array $attributes): void
    {
        $this->attributes = array_change_key_case($attributes, CASE_LOWER);
        $this->setupObject();
    }

    /**
     * Returns the assoc array of attributes.
     * All attribute names (keys) are lowercase.
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Gets a particular attribute by [case-insensitive] name.
     * If attribute is not set then the $defaultValue is returned.
     *
     * @param string $name         The [case-insensitive] name of the attribute to lookup.
     * @param mixed|null $defaultValue The default value to use in case the attribute is not set.
     *
     * @return mixed The value of the attribute or $defaultValue if not set.
     */
    public function getAttribute(string $name, mixed $defaultValue = null): mixed
    {
        $name = strtolower($name);
        return $this->attributes[$name] ?? $defaultValue;
    }

    /**
     * Converts value specified in XML to a boolean value.
     * This is to support the default value when used w/ a boolean column.
     *
     * @param $val
     * @return bool
     */
    protected function booleanValue($val): bool
    {
        if (is_numeric($val)) {
            return (bool) $val;
        } else {
            return in_array(strtolower($val), array('true', 't', 'y', 'yes'), true);
        }
    }

    protected function getDefaultValueForArray($stringValue): ?string
    {
        $stringValue = trim($stringValue);

        if (empty($stringValue)) {
            return null;
        }

        $values = array();
        foreach (explode(',', $stringValue) as $v) {
            $values[] = trim($v);
        }

        $value = implode(' | ', $values);
        if (empty($value) || ' | ' === $value) {
            return null;
        }

        return sprintf('||%s||', $value);
    }

    /**
     * Appends DOM elements to represent this object in XML.
     *
     * @param DOMNode $node
     */
    abstract public function appendXml(DOMNode $node);

    /**
     * Sets an associated VendorInfo object.
     *
     * @param mixed $data VendorInfo object or XML attrib data (array)
     *
     * @return VendorInfo
     */
    public function addVendorInfo(mixed $data): VendorInfo
    {
        if ($data instanceof VendorInfo) {
            $vi = $data;
            $this->vendorInfos[$vi->getType()] = $vi;

            return $vi;
        } else {
            $vi = new VendorInfo();
            $vi->loadFromXML($data);

            return $this->addVendorInfo($vi); // call self w/ different param
        }
    }

    /**
     * Gets any associated VendorInfo object.
     *
     * @param $type
     * @return VendorInfo
     */
    public function getVendorInfoForType($type): VendorInfo
    {
        return $this->vendorInfos[$type] ?? new VendorInfo($type);
    }

    /**
     * Find the best class name for a given behavior
     * Looks in build.properties for path like propel.behavior.[bname].class
     * If not found, tries to autoload [Bname]Behavior
     * If no success, returns 'Behavior'
     *
     * @param string $bname behavior name, e.g. 'timestampable'
     *
     * @return string behavior class name, e.g. 'TimestampableBehavior'
     *
     * @throws InvalidArgumentException
     */
    public function getConfiguredBehavior(string $bname): string
    {
        if ($config = $this->getGeneratorConfig()) {
            if ($class = $config->getConfiguredBehavior($bname)) {
                return $class;
            }
        }
        // fallback: maybe the behavior is loaded or autoloaded
        $gen = new PhpNameGenerator();
        if (class_exists($class = $gen->generateName(array($bname, PhpNameGenerator::CONV_METHOD_PHPNAME)) . 'Behavior')) {
            return $class;
        }

        throw new InvalidArgumentException(sprintf('Unknown behavior "%s"; make sure you configured the propel.behavior.%s.class setting in your build.properties', $bname, $bname));
    }

    /**
     * String representation of the current object.
     *
     * This is an xml representation with the XML declaration removed.
     *
     * @see        appendXml()
     */
    public function toString(): string
    {
        $doc = new DOMDocument('1.0');
        $doc->formatOutput = true;
        $this->appendXml($doc);
        $xmlstr = $doc->saveXML();

        return trim(preg_replace('/<\?xml.*?\?>/', '', $xmlstr));
    }

    /**
     * Magic string method
     *
     * @see toString()
     */
    public function __toString()
    {
        return $this->toString();
    }
}
