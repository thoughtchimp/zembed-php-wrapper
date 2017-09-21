# Zembed SDK for PHP

This repository contains the open source PHP SDK that allows you to access the Zembed API from your PHP app.


## Installation

The Zembed SDK can be installed with [Composer](https://getcomposer.org/). Run this command:

```sh
composer require thoughtchimp/zembed-php-wrapper
```

## Usage

> **Note:** This version of the Zembed SDK for PHP requires PHP 5.5 or greater.


#### Instantiating SDK

```php
use Zembed\API;

$api = API('Pass api_key here');
```

#### Get single embed

```php
$embed = $api->embed('http://thoughtchimp.com');
```

#### Get multiple embeds

```php
$embeds = $api->embeds([
    'http://rohitkhatri.com',
    'http://thoughtchimp.com',
    'https://google.com'
]);
```

Complete documentation is available [here](http://thoughtchimp.com).
