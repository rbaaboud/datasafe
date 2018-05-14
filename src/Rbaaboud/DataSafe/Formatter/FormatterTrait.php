<?php

namespace Rbaaboud\DataSafe\Formatter;

/**
 * Trait FormatterTrait
 *
 * @package Rbaaboud\DataSafe\Formatter
 */
trait FormatterTrait
{
    /**
     * Formatter
     *
     * @var \Rbaaboud\DataSafe\Formatter\FormatterInterface
     */
    protected $formatter;

    /**
     * Format value to crypt/uncrypt
     *
     * @param mixed $value
     * @return string
     * @throws \Rbaaboud\DataSafe\Exception
     */
    protected function format($value)
    {
        $formattedValue = null;

        if (is_array($value)) {
            $formattedValue = '';

            foreach ($value as $k => $v) {
                $formattedValue .= $this->format($value);
            }
        } else if (is_string($value) && $value === '') {
            $formattedValue = $this->formatter->fromEmptyString($value);
        } else if (is_string($value) && $value !== '') {
            $formattedValue = $this->formatter->fromString($value);
        } else if (is_integer($value)) {
            $formattedValue = $this->formatter->fromInteger($value);
        } else if (is_float($value)) {
            $formattedValue = $this->formatter->fromFloat($value);
        } else if (is_null($value)) {
            $formattedValue = $this->formatter->fromNull($value);
        } else if (is_bool($value)) {
            $formattedValue = $this->formatter->fromBoolean($value);
        } else {
            throw new \Rbaaboud\DataSafe\Exception\Formatter(
                'Failed to format value. ' .
                'Accepted value types: array, string, integer, float, null, boolean. ' .
                'Given value type: ' . var_export(gettype($value), true)
            );
        }

        if (!is_string($formattedValue)) {
            throw new \Rbaaboud\DataSafe\Exception\Formatter(
                'Failed to format value. ' .
                'Formatter must return a stirng. ' .
                'Given value type: ' . var_export(gettype($formattedValue), true)
            );
        }

        return $formattedValue;
    }
}
