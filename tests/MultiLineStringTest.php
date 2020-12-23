<?php

use Ballen\Cartographer\LineString;
use Ballen\Cartographer\MultiLineString;
use Ballen\Cartographer\Core\LatLong;
use PHPUnit\Framework\TestCase;

class MultiLineStringTest extends TestCase
{

    private $collection;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testMultiLineStringGenerate()
    {
        $coords1 = [
            new LatLong(51.51259, -0.12514),
            new LatLong(51.51537, -0.01614),
            new LatLong(51.48758, -0.06111),
            new LatLong(51.48267, -0.35328),
        ];
        $linestring = new LineString($coords1);
        $coords2 = [
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
        $multilinestring = new MultiLineString(
            [
                new LineString($coords1),
                new LineString($coords2)
            ]
        );
        $this->assertEquals(
            '{"type":"MultiLineString","coordinates":[[[-0.12514,51.51259],[-0.01614,51.51537],[-0.06111,51.48758],[-0.35328,51.48267]],[[1.045057,52.0057],[1.045329,52.005651],[1.045709,52.005521],[1.046035,52.005348],[1.046356,52.005262],[1.046561,52.005181],[1.04686,52.005074],[1.047102,52.005038],[1.047338,52.005029],[1.047543,52.005042],[1.047982,52.005103],[1.048789,52.005257]]]}',
            $multilinestring->generate()
        );
    }

    public function testMultiLineStringGenerateValidationError()
    {
        $this->expectException(\Ballen\Cartographer\Exceptions\TypeSchemaValidationException::class);
        $emptyCollection = new MultiLineString();
        $emptyCollection->generate();
    }
}
