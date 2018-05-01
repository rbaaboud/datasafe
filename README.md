# rbaaboud/datasafe

Services to secure data by providing Crypt and Uncrypt API.

## Installation

Via Composer

``` bash

$ composer require rbaaboud/datasafe

```

## Setup

__settings / app parameters__

```php

<?php

return [
    'datasafe' => [
        'crypt' => [
            // method, see openssl_get_cipher_methods()
            'method' => 'AES-256-CFB',
            
            // key, see openssl_encrypt()
            'key' => 'vr6EkKQ8S8vuxnchzKJbmqPUbkm9mX5L',
            
            // options, see openssl_encrypt()
            'options' => 0,
            
            // iv, see openssl_encrypt() and openssl_cipher_iv_length()
            'iv' => 'cvXKhMvNk2LEYpG2'
        ]
    ]
];

```

__dependencies / services__

Register service in Container.

Factory ensures that valid settings are present and runs validator.

```php

<?php

/**
 * @param \Psr\Container\ContainerInterface $container
 * @return \Rbaaboud\DataSafe\Crypt
 */
$container['datasafe'] = function (\Psr\Container\ContainerInterface $container) {
    $factory = new \Rbaaboud\DataSafe\Crypt\Factory();

    // settings
    $settingsService = $container->get('settings');

    // formatter
    // or a custom formatter that implements \Rbaaboud\DataSafe\Formatter\FormatterInterface
    $formatter = new \Rbaaboud\DataSafe\Formatter();

    return $factory($settingsService['datasafe']['crypt'], $formatter);
};

```

## Usage

```php

<?php

// get datasafe service
/** @var \Rbaaboud\DataSafe\Crypt $datasafeService */
$datasafeService = $this->container->get('datasafe');

// crypt

// returns crypted string
$datasafeService->crypt('test');

// cryptArray

// returns array with all values crypted
$datasafeService->cryptArray([
    'foo',
    'bar'
]);

// returns array with only 'index2' value crypted
$datasafeService->cryptArray([
    'index1' => 'foo',
    'index2' => 'bar'
], [
    'index2'
]);

// uncrypt

// returns uncrypted string
$datasafeService->uncrypt('d91wtw==');

// uncryptArray

// returns array with all values uncrypted
$datasafeService->uncryptArray([
    'Zdds',
    'd91wtw=='
]);

// returns array with only 'index2' value uncrypted
$datasafeService->uncryptArray([
    'index1' => 'Zdds',
    'index2' => 'd91wtw=='
], [
    'index2'
]);

```

## Testing

```bash

$ composer test

```
