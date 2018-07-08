# PHP SMS Fetcher

![Minimal PHP version](https://img.shields.io/packagist/php-v/stajor/sms-fetcher.svg)
[![Build Status](https://api.travis-ci.org/Stajor/sms-fetcher.svg?branch=master)](https://travis-ci.org/Stajor/sms-fetcher)

This PHP library will help you to fetch virtual and real phone numbers.
These phone numbers are public phone numbers where you can receive SMS online from forums or social media platforms like: Yahoo, serverloft, CloudSigma, Amazon, NAVERLINE, OKru, RealStatus etc.

## Installation

Add this line to your application's composer.json:

```json
{
    "require": {
        "stajor/sms-fetcher": "^1.1"
    }
}
```
and run `composer update`

**Or** run this command in your command line:

    $ composer require stajor/sms-fetcher
    
## Usage

```php
<?php

$client = new \SMSFetcher\Client();

/*will return supported list of providers*/
$providers = $client->getProviders();

/*will return provider object*/
$provider = $client->getProvider('receive-sms-online.info');

/*will return phone numbers array*/
$provider->getNumbers();
```

## Supported providers
* receive-sms-online.info
* getfreesmsnumber.com
* smsreceive.eu
* receivesms.co
* sms-online.co
* receive-sms-online.com
* freeonlinephone.org
* sms.sellaite.com
* receive-sms.com
* receive-a-sms.com

## Contributing

Bug reports and pull requests are welcome on GitHub at https://github.com/Stajor/sms-fetcher. This project is intended to be a safe, welcoming space for collaboration, and contributors are expected to adhere to the [Contributor Covenant](http://contributor-covenant.org) code of conduct.

## License

The gem is available as open source under the terms of the [MIT License](https://opensource.org/licenses/MIT).