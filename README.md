# Cartographer

[![Build Status](https://scrutinizer-ci.com/g/bobsta63/cartographer/badges/build.png?b=master)](https://scrutinizer-ci.com/g/bobsta63/cartographer/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/bobsta63/cartographer/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/bobsta63/cartographer/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bobsta63/cartographer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bobsta63/cartographer/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/ballen/cartographer/v/stable)](https://packagist.org/packages/ballen/cartographer)
[![Latest Unstable Version](https://poser.pugx.org/ballen/cartographer/v/unstable)](https://packagist.org/packages/ballen/cartographer)
[![License](https://poser.pugx.org/ballen/cartographer/license)](https://packagist.org/packages/ballen/cartographer)

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

### Point

The "Point" type is the most basic to construct, this example shows an example of plotting a single point on a map.

```php
use Ballen\Cartographer\Core\LatLong;
use Ballen\Cartographer\Point;

$point = new Point(new LatLong(52.005523, 1.045936));
echo $point->generate();
// {"type":"Point","coordinates":[1.045936,52.005523]}
```

The constructed GitHub GeoJSON map looks as follows:

```geojson
{"type":"Point","coordinates":[1.045936,52.005523]}
```

### Linestring

The "LineString" type contains a list of geographic points (Lat/Longs) of which are joined together to display a line.

```php
use Ballen\Cartographer\Core\LatLong;
use Ballen\Cartographer\LineString;

$points = [
    new LatLong(51.973683,1.044497),
    new LatLong(51.974067,1.044134),
    new LatLong(51.974355,1.045795),
    new LatLong(51.975010,1.049768),
    new LatLong(51.976018,1.055869),
    new LatLong(51.976195,1.056060),
    new LatLong(51.976432,1.056083),
    new LatLong(51.976774,1.056036),
    new LatLong(51.977023,1.056115),
    new LatLong(51.977107,1.056379),
    new LatLong(51.977102,1.056658),
 ];
$linestring = new LineString($points);
echo $linestring->generate();
// {"type":"LineString","coordinates":[[1.044497,51.973683],[1.044134,51.974067],[1.045795,51.974355],[1.049768,51.97501],[1.055869,51.976018],[1.05606,51.976195],[1.056083,51.976432],[1.056036,51.976774],[1.056115,51.977023],[1.056379,51.977107],[1.056658,51.977102]]}
```

The constructed GitHub GeoJSON map looks as follows:

```geojson
{"type":"LineString","coordinates":[[1.044497,51.973683],[1.044134,51.974067],[1.045795,51.974355],[1.049768,51.97501],[1.055869,51.976018],[1.05606,51.976195],[1.056083,51.976432],[1.056036,51.976774],[1.056115,51.977023],[1.056379,51.977107],[1.056658,51.977102]]}
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