# currency-rates
## Installation:
Currency Rates Package supports Laravel 5.5 and higher.
##Package
Require via composer
* composer require abdelrahmanbadr/currency-rates
* In your .env file set exchangeratesapi url in EXCHANGE_RATES_API_URL
* In your .env file set cache enabled or disabled (true or false)  CURRENCY_RATES_CACHE_IS_ENABLED
* In your .env file set expiry time for cache (integer) CURRENCY_RATES_CACHE_EXPIRY

### Usage:
Let's get the rates of EUR and GBP with USD as the base currency:

```php
use Abdelrahman_badr\CurrencyRates\Core\Facades\CurrencyService;

$currency = CurrencyService::getLatest("EUR",["GBP","USD"]);

$rates = $currency->rates;
```
By default, the base currency is `EUR`, so if that's your base, there's no need to set it. The symbols can be omitted too, as Exchange Rates Api will return all the supported currencies.

A simplified example without the base and currency:
```php
$currency = CurrencyService::getLatest();
```

The `historical` option will return currency rates for every day since the dates you've specified. The base currency and symbols can be omitted here to, but let's see a full example:

```php
$currency = CurrencyService::getHistorical(new \DateTime(),(new \DateTime())->modify('-15 days'),"EUR",["GBP","USD"]);
```
This will get available rates from 15 days ago till today  

`export latest rates to csv` take the file name and same parameters for `getLatest` function
```php
CurrencyService::exportLatest('fliename');
```

`export historical rates to csv` take the file name and same parameters for `getHistorical` function
```php
CurrencyService::exportHistorical('fliename',new \DateTime(),new \DateTime("2019-01-01"));
```
## Running Unit tests:
    $ ./vendor/bin/phpunit
 ## Nice To Have (@Todo):
    1. Add Cli Command To Get Currency Exchange Rates
    2- More validation for package user inputs
    3- Create convert service like convert 100 USD to EUR 
    4- Add more providers such as Fixerio and make config switch between them
    5- Add logs to trace errors
    6- Use transform layer for the result
    7- Use config file
