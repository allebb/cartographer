<?php
require '/../vendor/autoload.php';

/**
 * 
 */
use \Ballen\Distical\Entities\LatLong;

/**
 * Test adding some example coords to a LineString type GeoJSON object
 */
$testCoords = [
    new LatLong(51.51259, -0.12514),
    new LatLong(51.51537, -0.01614),
    new LatLong(51.48758, -0.06111),
    new LatLong(51.48267, -0.35328),
];
$test = new \Ballen\Cartographer\LineString($testCoords);
$test->generate();
