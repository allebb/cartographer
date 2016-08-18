<?php
require __DIR__ . '/../vendor/autoload.php';
/**
 * 
 */
use \Ballen\Distical\Entities\LatLong;

/**
 * Test a LineString type.
 */
$testCoords = [
    new LatLong(51.51259, -0.12514),
    new LatLong(51.51537, -0.01614),
    new LatLong(51.48758, -0.06111),
    new LatLong(51.48267, -0.35328),
];
$test = new \Ballen\Cartographer\LineString($testCoords);
echo $test->generate();


/**
 * Test adding a single Point.
 */
$point = new \Ballen\Cartographer\Point(new LatLong(52.005052, 1.047551));
echo $point->generate();

/**
 * Test a multipoint type.
 */
$multipoint = new \Ballen\Cartographer\MultiPoint($testCoords);
echo $multipoint->generate();