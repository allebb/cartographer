# Cartographer

[![Build Status](https://scrutinizer-ci.com/g/allebb/cartographer/badges/build.png?b=master)](https://scrutinizer-ci.com/g/allebb/cartographer/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/allebb/cartographer/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/allebb/cartographer/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/allebb/cartographer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/allebb/cartographer/?branch=master)
[![Code Climate](https://codeclimate.com/github/allebb/cartographer/badges/gpa.svg)](https://codeclimate.com/github/allebb/cartographer)
[![Latest Stable Version](https://poser.pugx.org/ballen/cartographer/v/stable)](https://packagist.org/packages/ballen/cartographer)
[![Latest Unstable Version](https://poser.pugx.org/ballen/cartographer/v/unstable)](https://packagist.org/packages/ballen/cartographer)
[![License](https://poser.pugx.org/ballen/cartographer/license)](https://packagist.org/packages/ballen/cartographer)

Cartographer is a PHP library providing the ability to programmatically generate GeoJSON objects.

GeoJSON is a format for encoding a variety of geographic data structures. A GeoJSON object may represent a geometry, a feature, or a collection of features. GeoJSON supports the following geometry types: ``Point``, ``LineString``, ``Polygon``, ``MultiPoint``, ``MultiLineString``, ``MultiPolygon``, and ``GeometryCollection``. Features in GeoJSON contain a geometry object and additional properties, and a feature collection represents a list of features.

Cartographer was written to adhear to the GeoJSON specification, information can be found here: http://geojson.org/geojson-spec.html

Requirements
------------

* PHP >= 5.5.0

This library is unit tested against PHP 5.5, 5.6, 7.0, 7.1 and HHVM!

License
-------

This client library is released under the [GPLv3](https://raw.githubusercontent.com/allebb/cartographer/master/LICENSE) license, you are welcome to use it, improve it and contribute your changes back!

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

Check out the GitHub Gist rendition of the GeoJSON output: https://gist.github.com/allebb/55f059efbd708be130112b6d39b16406

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

Check out the GitHub Gist rendition of the GeoJSON output: https://gist.github.com/allebb/ec422a00b877e28a3d6913df68c5954c

#### Polygon

A Polygon type object, contains a list of coordinates, the first and last coordinate must match. For Polygons with multiple rings, the first must be the exterior ring and any others must be interior rings or holes.

```php
use Ballen\Cartographer\Core\LatLong;
use Ballen\Cartographer\Polygon;
use Ballen\Cartographer\Core\LinearRing;

$points = [
    (new LatLong(52.064761, 1.174470))->lngLatArray(),
    (new LatLong(52.065045, 1.176098))->lngLatArray(),
    (new LatLong(52.064964, 1.176156))->lngLatArray(),
    (new LatLong(52.065172, 1.177106))->lngLatArray(),
    (new LatLong(52.064146, 1.177594))->lngLatArray(),
    (new LatLong(52.063968, 1.176768))->lngLatArray(),
    (new LatLong(52.063714, 1.174875))->lngLatArray(),
    (new LatLong(52.064761, 1.174470))->lngLatArray(),
];
$linestring = new Polygon((new LinearRing())->addRing($points));
echo $linestring->generate();
// {"type":"Polygon","coordinates":[[[1.17447,52.064761],[1.176098,52.065045],[1.176156,52.064964],[1.177106,52.065172],[1.177594,52.064146],[1.176768,52.063968],[1.174875,52.063714],[1.17447,52.064761]]]}
```

Check out the GitHub Gist rendition of the GeoJSON object: https://gist.github.com/allebb/30dd0db2a33b763309e64af8cfe3e33c

#### Feature

A feature enables you to plot a single GeoJSON object on a map with associated properties, Google Maps enable you to render ``Feature`` and ``FeatureCollection`` types.

A example of a ``Point`` feature type is as follows:

```php
use Ballen\Cartographer\Core\LatLong;
use Ballen\Cartographer\Feature;
use Ballen\Cartographer\Point;

$feature = new Feature(new Point(new LatLong(52.063186, 1.157385)), [
    // Your own personal marker points (appear when you click on the Feature point)
    'Park' => 'Christchurch Park',
    'Post code' => 'IP4 2BX',
    'Link' => 'http://focp.org.uk/',
    // Optional Mapbox supported properties (See: https://www.mapbox.com/help/markers/)
    'marker-color' => '#3bb2d0', // A light blue marker colour
    'marker-symbol' => 'park',
    'marker-size' => 'large',
]);
echo $feature->generate();
// {"type":"Feature","geometry":{"type":"Point","coordinates":[1.157385,52.063186]},"properties":{"Park":"Christchurch Park","Post code":"IP4 2BX","Link":"http:\/\/focp.org.uk\/","marker-color":"#3bb2d0","marker-symbol":"park","marker-size":"large"}}
```

Check out the GitHub Gist rendition of the GeoJSON output: https://gist.github.com/allebb/a1dfa013273cc75ce061a13250ae6683

#### Feature Collection

A feature collection can contain any number of GeoJSON objects with their own properties, all of the features in a collection with their own properties.

```php
use Ballen\Cartographer\Core\LatLong;
use Ballen\Cartographer\Feature;
use Ballen\Cartographer\Point;

$park = new Feature(new Point(new LatLong(52.063186, 1.157385)), [
    // Your own personal marker points (appear when you click on the Feature point)
    'Park' => 'Christchurch Park',
    'Post code' => 'IP4 2BX',
    'Link' => 'http://focp.org.uk/',
    // Optional Mapbox supported properties (See: https://www.mapbox.com/help/markers/)
    'marker-color' => '#3bb2d0', // A light blue marker colour
    'marker-symbol' => 'park',
    'marker-size' => 'large',
]);

// Train Station Specific codes
$station_properties = [
    'marker-color' => '#F6546A',
    'marker-symbol' => 'rail',
    'marker-size' => 'medium'
];

// Set some train stations with their own names (merge the standard train station details)
$station_central = new Feature(new Point(new LatLong(52.050743, 1.143012)), array_merge($station_properties, ['Name' => 'Ipswich Train Station']));
$station_derbyroad = new Feature(new Point(new LatLong(52.050808, 1.182638)), array_merge($station_properties, ['Name' => 'Derby Road Station']));
$station_westerfield = new Feature(new Point(new LatLong(52.081026, 1.166773)), array_merge($station_properties, ['Name' => 'Westerfield Train Station']));

// Create the new collection and add each of the GeoJSON objects to it...
$collection = new Ballen\Cartographer\FeatureCollection([$station_central, $park, $station_westerfield, $station_derbyroad]);
echo $collection->generate();
// {"type":"FeatureCollection","features":[{"type":"Feature","geometry":{"type":"Point","coordinates":[1.143012,52.050743]},"properties":{"marker-color":"#F6546A","marker-symbol":"rail","marker-size":"medium","Name":"Ipswich Train Station"}},{"type":"Feature","geometry":{"type":"Point","coordinates":[1.157385,52.063186]},"properties":{"Park":"Christchurch Park","Post code":"IP4 2BX","Link":"http:\/\/focp.org.uk\/","marker-color":"#3bb2d0","marker-symbol":"park","marker-size":"large"}},{"type":"Feature","geometry":{"type":"Point","coordinates":[1.166773,52.081026]},"properties":{"marker-color":"#F6546A","marker-symbol":"rail","marker-size":"medium","Name":"Westerfield Train Station"}},{"type":"Feature","geometry":{"type":"Point","coordinates":[1.182638,52.050808]},"properties":{"marker-color":"#F6546A","marker-symbol":"rail","marker-size":"medium","Name":"Derby Road Station"}}]}
```

Check out the GitHub Gist rendition of the GeoJSON output: https://gist.github.com/allebb/1802d538814ed0875ab05060a439b774

#### Other examples

Other examples of the types of GeoJSON object type, see the [examples/test.php](https://github.com/allebb/cartographer/blob/master/examples/test.php) file.

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
