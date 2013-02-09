<?php
namespace Clover\Text;

class LTSV
{
    const DELIMITER = "\t";
    const LABEL_VALUE_DELIMITER = ':';

    protected $values = array();

    public function __construct(array $values = array())
    {
        if (is_array($values) && !is_null($values)) {
            $this->values = $values;
        }
    }

    public function parseLine($line)
    {
        $parts = str_getcsv($line, self::DELIMITER);
        $values = array();
        $labelValueDelimiterLength = strlen(self::LABEL_VALUE_DELIMITER);
        foreach ($parts as $part) {
            $pos = strpos($part, self::LABEL_VALUE_DELIMITER);
            if ($pos !== false && $pos > 0) {
                $label = substr($part, 0, $pos);
                $value = substr($part, $pos + $labelValueDelimiterLength);
                $values[$label] = $value;
            }
        }
        return $values;
    }

    public function parseFile($path, array $options = array())
    {
        if (!is_readable($path) || !is_file($path)) {
            throw new \InvalidArgumentException("{$path} is not readable.");
        }
        $lines = file($path, FILE_SKIP_EMPTY_LINES);
        $values = array();
        foreach ($lines as $line) {
            $values[] = $this->parseLine($line);
        }
        return $values;
    }

    public function getIteratorFromFile($path, array $options = array())
    {
        $values = $this->parseFile($path, $options);
        $arrayObject = new \ArrayObject($values);
        return $arrayObject->getIterator();
    }

    public function __toString()
    {
        $parts = array();
        foreach ($this->values as $label => $value) {
            $parts[] = $label . self::LABEL_VALUE_DELIMITER . $value;
        }
        return implode(self::DELIMITER, $parts);
    }
}
