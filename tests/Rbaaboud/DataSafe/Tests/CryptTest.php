<?php

namespace Rbaaboud\DataSafe\Tests;

/**
 * Class CryptTest
 *
 * @package Rbaaboud\DataSafe\Tests
 */
class CryptTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Rbaaboud\DataSafe\Crypt
     */
    protected $cryptInstance;

    /**
     * Set Up
     *
     * @throws \Rbaaboud\DataSafe\Exception
     */
    protected function setUp()
    {
        $options = [
            'method' => 'AES-256-CFB',
            'key' => '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',
            'options' => 0,
            'iv' => 'so9v45ZvTYTalRoh'
        ];

        $factory = new \Rbaaboud\DataSafe\Crypt\Factory();

        $this->cryptInstance = $factory($options);
    }

    /**
     * Test crypt factory
     */
    public function testCryptFactory()
    {
        $this->assertInstanceOf(\Rbaaboud\DataSafe\Crypt::class, $this->cryptInstance);
    }

    /**
     * Test validate config with unknown method
     *
     * @throws \Rbaaboud\DataSafe\Exception
     *
     * @expectedException \Rbaaboud\DataSafe\Exception\Crypt\ValidateConfig\UnknownMethod
     */
    public function testValidateConfigWithUnknownMethod()
    {
        $formatter = new \Rbaaboud\DataSafe\Formatter();

        $cryptInstance = new \Rbaaboud\DataSafe\Crypt($formatter);

        $config = [
            'method' => 'TEST',
            'key' => 'vr6EkKQ8S8vuxnchzKJbmqPUbkm9mX5L',
            'options' => 0,
            'iv' => 'cvXKhMvNk2LEYpG2'
        ];

        $cryptInstance->setMethod($config['method']);
        $cryptInstance->setKey($config['key']);
        $cryptInstance->setOptions($config['options']);
        $cryptInstance->setIv($config['iv']);

        $cryptInstance->validateConfig();
    }

    /**
     * Test validate config with empty key
     *
     * @throws \Rbaaboud\DataSafe\Exception
     *
     * @expectedException \Rbaaboud\DataSafe\Exception\Crypt\ValidateConfig\EmptyKey
     */
    public function testValidateConfigWithEmptyKey()
    {
        $formatter = new \Rbaaboud\DataSafe\Formatter();

        $cryptInstance = new \Rbaaboud\DataSafe\Crypt($formatter);

        $config = [
            'method' => 'CAMELLIA-256-ECB',
            'key' => null,
            'options' => 0,
            'iv' => 'cvXKhMvNk2LEYpG2'
        ];

        $cryptInstance->setMethod($config['method']);
        $cryptInstance->setKey($config['key']);
        $cryptInstance->setOptions($config['options']);
        $cryptInstance->setIv($config['iv']);

        $cryptInstance->validateConfig();
    }

    /**
     * Test validate config with invalid iv length
     *
     * @throws \Rbaaboud\DataSafe\Exception
     *
     * @expectedException \Rbaaboud\DataSafe\Exception\Crypt\ValidateConfig\InvalidIvLength
     */
    public function testValidateConfigWithInvalidIvLength()
    {
        $formatter = new \Rbaaboud\DataSafe\Formatter();

        $cryptInstance = new \Rbaaboud\DataSafe\Crypt($formatter);

        $config = [
            'method' => 'CAMELLIA-256-ECB',
            'key' => 'hHPNga3Hm93NaHNnzvDEDGxaVDAsu4k3',
            'options' => 0,
            'iv' => 'cvXKhMvNk2LEYpG2'
        ];

        $cryptInstance->setMethod($config['method']);
        $cryptInstance->setKey($config['key']);
        $cryptInstance->setOptions($config['options']);
        $cryptInstance->setIv($config['iv']);

        $cryptInstance->validateConfig();
    }

    /**
     * Test crypt
     *
     * @throws \Rbaaboud\DataSafe\Exception
     */
    public function testCrypt()
    {
        $expected = 'd91wtw==';
        $actual = $this->cryptInstance->crypt('test');

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test crypt array without only fields
     *
     * @throws \Rbaaboud\DataSafe\Exception
     */
    public function testCryptArrayWithoutOnlyFields()
    {
        $expected = [
            'Zdds',
            'd91wtw=='
        ];

        $actual = $this->cryptInstance->cryptArray(
            [
                'foo',
                'test'
            ]
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test crypt array with only fields
     *
     * @throws \Rbaaboud\DataSafe\Exception
     */
    public function testCryptArrayWithOnlyFields()
    {
        $expected = [
            'testField1' => 'foo',
            'testField2' => 'd91wtw=='
        ];

        $actual = $this->cryptInstance->cryptArray(
            [
                'testField1' => 'foo',
                'testField2' => 'test'
            ],
            [
                'testField2'
            ]
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test uncrypt
     *
     * @throws \Rbaaboud\DataSafe\Exception
     */
    public function testUncrypt()
    {
        $expected = 'test';
        $actual = $this->cryptInstance->uncrypt('d91wtw==');

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test uncrypt array without only fields
     *
     * @throws \Rbaaboud\DataSafe\Exception
     */
    public function testUncryptArrayWithoutOnlyFields()
    {
        $expected = [
            'foo',
            'test'
        ];

        $actual = $this->cryptInstance->uncryptArray(
            [
                'Zdds',
                'd91wtw=='
            ]
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test uncrypt array with only fields
     *
     * @throws \Rbaaboud\DataSafe\Exception
     */
    public function testUncryptArrayWithOnlyFields()
    {
        $expected = [
            'testField1' => 'foo',
            'testField2' => 'test'
        ];

        $actual = $this->cryptInstance->uncryptArray(
            [
                'testField1' => 'foo',
                'testField2' => 'd91wtw=='
            ],
            [
                'testField2'
            ]
        );

        $this->assertEquals($expected, $actual);
    }
}
