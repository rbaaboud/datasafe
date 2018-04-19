<?php

namespace Rbaaboud\DataSafe;

/**
 * Class Formatter
 *
 * @package Rbaaboud\DataSafe
 */
class Formatter implements \Rbaaboud\DataSafe\Formatter\FormatterInterface
{
    /**
     * @inheritdoc
     */
    public function fromString($value)
    {
        return trim($value);
    }

    /**
     * @inheritdoc
     */
    public function fromEmptyStirng($value)
    {
        return '';
    }

    /**
     * @inheritdoc
     */
    public function fromInteger($value)
    {
        return (string)$value;
    }

    /**
     * @inheritdoc
     */
    public function fromFloat($value)
    {
        return (string)$value;
    }

    /**
     * @inheritdoc
     */
    public function fromNull($value)
    {
        return 'NULL';
    }

    /**
     * @inheritdoc
     */
    public function fromBoolean($value)
    {
        return $value === true ? 'TRUE' : 'FALSE';
    }
}
