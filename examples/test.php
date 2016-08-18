<?php
require __DIR__ . '/../vendor/autoload.php';
/**
 * 
 */
use \Ballen\Distical\Entities\LatLong;
use Ballen\Cartographer\LineString;

/**
 * Test a LineString type.
 */
$testCoords = [
    new LatLong(51.51259, -0.12514),
    new LatLong(51.51537, -0.01614),
    new LatLong(51.48758, -0.06111),
    new LatLong(51.48267, -0.35328),
];
$linestring = new \Ballen\Cartographer\LineString($testCoords);
//echo $linestring->generate();


/**
 * Test adding a single Point.
 */
$point = new \Ballen\Cartographer\Point(new LatLong(52.005052, 1.047551));
//echo $point->generate();

/**
 * Test a multipoint type.
 */
$multipoint = new \Ballen\Cartographer\MultiPoint($testCoords);
//echo $multipoint->generate();

/**
 * Test a multipointstring type.
 */
$roadCoords = [
    new LatLong(52.005700, 1.045057),
    new LatLong(52.005651, 1.045329),
    new LatLong(52.005521, 1.045709),
    new LatLong(52.005348, 1.046035),
    new LatLong(52.005262, 1.046356),
    new LatLong(52.005181, 1.046561),
    new LatLong(52.005074, 1.046860),
    new LatLong(52.005038, 1.047102),
    new LatLong(52.005029, 1.047338),
    new LatLong(52.005042, 1.047543),
    new LatLong(52.005103, 1.047982),
    new LatLong(52.005257, 1.048789),
];
$multilinestring = new \Ballen\Cartographer\MultiLineString([
    new LineString($testCoords),
    new LineString($roadCoords)]
);
//echo $multilinestring->generate();


/**
 * Test a polygon type.
 */
$polygon_example = json_decode(file_get_contents(__DIR__ . '/polygon.json'), true);
//die(var_dump($polygon_example));
//die(var_dump($polygon_example->coordinates[0]));
//$polygonCoords = json_decode($polygon_example->coordinates, true);
//die(var_dump($polygone_example->coordinates));
$polygon = new \Ballen\Cartographer\Polygon();
//die(var_dump($polygon_example['coordinates']));
foreach ($polygon_example['coordinates'] as $poly) {
    //die(var_dump($polygon));
    foreach ($poly as $ordinal) {
        $polygon->addCoordinate(new LatLong($ordinal[0], $ordinal[1]));
    }
}

//echo $polygon->generate();

/**
 * Test a GeometryCollection type
 */
$geometryCollection_example = new Ballen\Cartographer\GeometryCollection([$linestring, $point]);
echo $geometryCollection_example->generate();