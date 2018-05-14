<?php

namespace Rbaaboud\DataSafe\Formatter;

/**
 * Interface FormatterInterface
 *
 * @package Rbaaboud\DataSafe\Formatter
 */
interface FormatterInterface
{
    /**
     * Format string
     *
     * @param string $value
     * @return string
     */
    public function fromString($value);

    /**
     * Format empty string
     *
     * @param string $value
     * @return string
     */
    public function fromEmptyString($value);

    /**
     * Format integer
     *
     * @param integer $value
     * @return string
     */
    public function fromInteger($value);

    /**
     * Format float
     *
     * @param float $value
     * @return string
     */
    public function fromFloat($value);

    /**
     * Format NULL
     *
     * @param null $value
     * @return string
     */
    public function fromNull($value);

    /**
     * Format boolean
     *
     * @param boolean $value
     * @return string
     */
    public function fromBoolean($value);
}
