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

        $cryptInstance = new \Rbaaboud\DataSafe\Crypt($formatter);

        $cryptInstance->setMethod($config['method']);
        $cryptInstance->setKey($config['key']);
        $cryptInstance->setOptions($config['options']);
        $cryptInstance->setIv($config['iv']);

        $cryptInstance->validateConfig();

        return $cryptInstance;
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
