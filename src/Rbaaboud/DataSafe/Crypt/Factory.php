<?php

namespace Rbaaboud\DataSafe\Crypt;

/**
 * Class Factory
 *
 * @package Rbaaboud\DataSafe\Crypt
 */
class Factory implements \Interop\Config\RequiresConfig, \Interop\Config\RequiresMandatoryOptions
{
    use \Interop\Config\ConfigurationTrait;

    /**
     * Invoke
     *
     * @param array $options
     * @param \Rbaaboud\DataSafe\Formatter\FormatterInterface|null $formatter
     * @return \Rbaaboud\DataSafe\Crypt
     * @throws \Rbaaboud\DataSafe\Exception
     */
    public function __invoke(array $options, \Rbaaboud\DataSafe\Formatter\FormatterInterface $formatter = null)
    {
        $config = $this->options($options);

        if ($formatter === null) {
            $formatter = new \Rbaaboud\DataSafe\Formatter();
        }

        $crypt = new \Rbaaboud\DataSafe\Crypt($formatter);

        $crypt->setMethod($config['method']);
        $crypt->setKey($config['key']);
        $crypt->setOptions($config['options']);
        $crypt->setIv($config['iv']);

        $crypt->validateConfig();

        return $crypt;
    }

    /**
     * @return array
     */
    public function dimensions()
    {
        return [];
    }

    /**
     * @return array
     */
    public function mandatoryOptions()
    {
        return [
            'method',
            'key',
            'options',
            'iv'
        ];
    }
}
