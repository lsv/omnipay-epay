OmniPay: ePay
=============

**ePay driver for the Omnipay PHP payment processing library**

[![Build Status](https://travis-ci.org/lsv/omnipay-epay.svg)](https://travis-ci.org/lsv/omnipay-epay) [![Latest Stable Version](https://poser.pugx.org/lsv/omnipay-epay/version)](https://packagist.org/packages/lsv/omnipay-epay) [![Coverage Status](https://coveralls.io/repos/lsv/omnipay-epay/badge.png?branch=master)](https://coveralls.io/r/lsv/omnipay-epay?branch=master)

Installation
------------

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it to your `composer.json` file:

```json
{
    "require": {
        "lsv/omnipay-epay": "~1.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

Basic Usage
-----------

The following gateways are provided by this package:

* [ePay](http://epay.dk/epay-payment-solutions/)

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay) repository.
