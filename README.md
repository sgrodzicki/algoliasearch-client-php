# Algolia Search API Client for PHP

[![Build Status](https://travis-ci.org/sgrodzicki/algoliasearch-client-php.png)](https://travis-ci.org/sgrodzicki/algoliasearch-client-php)

This PHP client let you easily use the Algolia Search API from your backend.

## Installation

The Algolia Search API Client is available [on Packagist](https://packagist.org/packages/sgrodzicki/algoliasearch-api-client) and as such installable via [Composer](http://getcomposer.org).

If you do not use Composer, you can grab the code from GitHub, and use any PSR-0 compatible autoloader (e.g. the [Symfony2 ClassLoader component](https://github.com/symfony/ClassLoader)) to load the library's classes.

### Composer example

Add "sgrodzicki/algoliasearch-api-client" in your composer.json:

```js
{
    "require": {
        "sgrodzicki/algoliasearch-api-client": "1.0.*"
    }
}
```

Download the library:

``` bash
$ php composer.phar update sgrodzicki/algoliasearch-api-client
```

After installing, you need to require Composer's autoloader somewhere in your code:

```php
require_once 'vendor/autoload.php';
```

## Usage

```php
use Algolia\SearchApiClient\Client\AlgoliaSearchClient;

$client  = AlgoliaSearchClient::factory(array(
    'application_id' => 'your_application_id',
    'api_key'        => 'your_api_key',
));
$indexes = $client->listIndexes(); // returns an array of your indexes
```

You can find a list of the client's available commands in the bundle's [client.json](https://github.com/sgrodzicki/algoliasearch-client-php/blob/master/lib/Algolia/SearchApiClient/Resources/config/client.json) but basically they should be the same as the [api endpoints listed in the docs](http://docs.algoliav1.apiary.io).
