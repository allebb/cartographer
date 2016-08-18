# Cartographer

Cartographer is a PHP library providing the ability to programmatically generate GeoJSON objects.

GeoJSON is a format for encoding a variety of geographic data structures. A GeoJSON object may represent a geometry, a feature, or a collection of features. GeoJSON supports the following geometry types: ``Point``, ``LineString``, ``Polygon``, ``MultiPoint``, ``MultiLineString``, ``MultiPolygon``, and ``GeometryCollection``. Features in GeoJSON contain a geometry object and additional properties, and a feature collection represents a list of features.

Requirements
------------

* PHP >= 5.5.0

This library is unit tested against PHP 5.5, 5.6, 7.0 and HHVM!

License
-------

This client library is released under the [GPLv3](https://raw.githubusercontent.com/bobsta63/cartographer/master/LICENSE) license, you are welcome to use it, improve it and contribute your changes back!

Installation
------------

The recommended way of installing this library is via. [Composer](http://getcomposer.org); To install using Composer type the following command at the console:

```shell
composer require ballen/cartographer
```

Alternately you can add it to your ``composer.json`` file manually in the `require` section like so:

```php
"ballen/cartographer": "^1.0"
```
Then install the package by running the ``composer update ballen/cartographer`` command.

Example usage
-------------

```php
/**
* TBC
*/
```

Tests and coverage
------------------

This library is fully unit tested using [PHPUnit](https://phpunit.de/).

I use [TravisCI](https://travis-ci.org/) for continuous integration, which triggers tests for PHP 5.5, 5.6, 7.0 and HHVM every time a commit is pushed.

If you wish to run the tests yourself you should run the following:

```shell
# Install the Cartographer Library (which will include PHPUnit as part of the require-dev dependencies)
composer install

# Now we run the unit tests (from the root of the project) like so:
./vendor/bin/phpunit
```

Code coverage can also be ran and a report generated (this does require XDebug to be installed)...

```shell
./vendor/bin/phpunit --coverage-html ./report
```

Support
-------

I am happy to provide support via. my personal email address, so if you need a hand drop me an email at: [ballen@bobbyallen.me](mailto:ballen@bobbyallen.me).