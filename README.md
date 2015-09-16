# Laravel 5.1 LetsAds Service Provider

Laravel 5.1 package for [LetsAds](http://letsads.com) SMS provider.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rhincodon/laravel-letsads.svg?style=flat-square)](https://packagist.org/packages/rhincodon/laravel-letsads)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/Rhincodon/laravel-letsads/master.svg?style=flat-square)](https://travis-ci.org/Rhincodon/laravel-letsads)
[![Total Downloads](https://img.shields.io/packagist/dt/rhincodon/laravel-letsads.svg?style=flat-square)](https://packagist.org/packages/rhincodon/laravel-letsads)

## Install

You can install the package via composer:
``` bash
$ composer require rhincodon/laravel-letsads
```

This service provider must be installed. And facade:
```php
// config/app.php
'providers' => [
    ...
    Rhinodontypicus\LetsAds\LetsAdsServiceProvider::class,
];
'aliases' => [
    'LetsAds' => Rhinodontypicus\LetsAds\LetsAdsFacade::class
];
```

You can publish the migration with:
```bash
php artisan vendor:publish --provider="Rhinodontypicus\LetsAds\LetsAdsServiceProvider"
```

## Usage

In all cases will be returned SimpleXML object with appropriate information about action or ErrorException:

```php
use LetsAds;

// Get balance
LetsAds::balance();

// Send messages
// $phones may be string or array
LetsAds::send($message, $from, $phones);

// Get messages statuses
LetsAds::status($messageId);
```

## Credits

- [rhinodontypicus](https://github.com/rhincodon)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.