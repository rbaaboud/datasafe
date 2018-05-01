<?php

namespace Rbaaboud\DataSafe;

/**
 * Class Crypt
 *
 * @package Rbaaboud\DataSafe
 */
class Crypt
{
    use \Rbaaboud\DataSafe\Formatter\FormatterTrait;

    /**
     * The cipher method.
     * For a list of available cipher methods, use openssl_get_cipher_methods()
     *
     * @var string
     */
    protected $method;

    /**
     * The key
     *
     * @var string
     */
    protected $key;

    /**
     * options is a bitwise disjunction of the flags OPENSSL_RAW_DATA and OPENSSL_ZERO_PADDING.
     *
     * @var int
     */
    protected $options = 0;

    /**
     * A non-NULL Initialization Vector.
     *
     * @var string
     */
    protected $iv;

    /**
     * Crypt constructor.
     *
     * @param \Rbaaboud\DataSafe\Formatter\FormatterInterface $formatter
     */
    public function __construct(\Rbaaboud\DataSafe\Formatter\FormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * Crypt string value for given config
     *
     * @param string $stringToCrypt
     * @return string
     * @throws \Rbaaboud\DataSafe\Exception
     */
    public function crypt($stringToCrypt)
    {
        $this->validateConfig();

        return openssl_encrypt($this->format($stringToCrypt), $this->getMethod(), $this->getKey(), $this->getOptions(), $this->getIv());
    }

    /**
     * Crypt array data for given config
     *
     * @param array $arrayDataToCrypt
     * @param array|null $onlyFields
     * @return array
     * @throws \Rbaaboud\DataSafe\Exception
     */
    public function cryptArray(array $arrayDataToCrypt, array $onlyFields = null)
    {
        if ($onlyFields === null) {
            $onlyFields = array_keys($arrayDataToCrypt);
        }

        foreach ($onlyFields as $fieldName) {
            if (!array_key_exists($fieldName, $arrayDataToCrypt)) {
                continue;
            }

            $arrayDataToCrypt[$fieldName] = $this->crypt($arrayDataToCrypt[$fieldName]);
        }

        return $arrayDataToCrypt;
    }

    /**
     * Uncrypt string value for given config
     *
     * @param string $stringToUncrypt
     * @return string
     * @throws \Rbaaboud\DataSafe\Exception
     */
    public function uncrypt($stringToUncrypt)
    {
        $this->validateConfig();

        return openssl_decrypt($this->format($stringToUncrypt), $this->getMethod(), $this->getKey(), $this->getOptions(), $this->getIv());
    }

    /**
     * Uncrypt array data for given config
     *
     * @param array $arrayDataToUncrypt
     * @param array|null $onlyFields
     * @return array
     * @throws \Rbaaboud\DataSafe\Exception
     */
    public function uncryptArray(array $arrayDataToUncrypt, array $onlyFields = null)
    {
        if ($onlyFields === null) {
            $onlyFields = array_keys($arrayDataToUncrypt);
        }

        foreach ($onlyFields as $fieldName) {
            if (!array_key_exists($fieldName, $arrayDataToUncrypt)) {
                continue;
            }

            $arrayDataToUncrypt[$fieldName] = $this->uncrypt($arrayDataToUncrypt[$fieldName]);
        }

        return $arrayDataToUncrypt;
    }

    /**
     * Validation crypt configuration (method, key, iv length)
     *
     * @return $this
     * @throws \Rbaaboud\DataSafe\Exception\Crypt\ValidateConfig
     */
    public function validateConfig()
    {
        $method = strtolower($this->getMethod());

        if (!in_array($method, openssl_get_cipher_methods())) {
            throw new \Rbaaboud\DataSafe\Exception\Crypt\ValidateConfig\UnknownMethod(
                'Failed to validate config. ' .
                'Crypt method seems unknown on this server. ' .
                'See known methods by calling openssl_get_cipher_methods().'
            );
        }

        $keyLength = strlen($this->getKey());
        if ($keyLength === 0) {
            throw new \Rbaaboud\DataSafe\Exception\Crypt\ValidateConfig\EmptyKey(
                'Failed to validate config. ' .
                'Key is empty.'
            );
        }

        $ivLength = strlen($this->getIv());
        $expectedLength = openssl_cipher_iv_length($method);

        if ($ivLength !== $expectedLength) {
            throw new \Rbaaboud\DataSafe\Exception\Crypt\ValidateConfig\InvalidIvLength(
                'Failed to validate config. ' .
                'Iv length is not as expected for given crypt method. ' .
                'actual: ' . var_export($ivLength, true) . ', ' .
                'expected: ' . var_export($expectedLength, true) . '.'
            );
        }

        return $this;
    }

    /**
     * Get method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set method
     *
     * @param string $method
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set key
     *
     * @param string $key
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get options
     *
     * @return int
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set options
     *
     * @param int $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get iv
     *
     * @return string
     */
    public function getIv()
    {
        return $this->iv;
    }

    /**
     * Set iv
     *
     * @param string $iv
     * @return $this
     */
    public function setIv($iv)
    {
        $this->iv = $iv;

        return $this;
    }
}
