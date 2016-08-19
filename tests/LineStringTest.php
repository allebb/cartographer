<?php
use Ballen\Cartographer\LineString;
use Ballen\Distical\Entities\LatLong;

class LineStringTest extends PHPUnit_Framework_TestCase
{

    public function testLineString()
    {
        $testCoords = [
            new LatLong(51.51259, -0.12514),
            new LatLong(51.51537, -0.01614),
            new LatLong(51.48758, -0.06111),
            new LatLong(51.48267, -0.35328),
        ];
        $linestring = new LineString($testCoords);
        $this->assertEquals('{"type":"LineString","coordinates":[[-0.12514,51.51259],[-0.01614,51.51537],[-0.06111,51.48758],[-0.35328,51.48267]]}', $linestring->generate());
    }

    public function testLineStringLessThanTwoCoords()
    {

        $this->setExpectedException(\Ballen\Cartographer\Exceptions\TypeSchemaValidationException::class);
        $testCoords = [
            new LatLong(51.51259, -0.12514),
        ];
        $linestring = new LineString($testCoords);
        $linestring->generate();
    }

    public function testLineStringExportToArray()
    {
        $testCoords = [
            new LatLong(51.51259, -0.12514),
            new LatLong(51.51537, -0.01614),
            new LatLong(51.48758, -0.06111),
            new LatLong(51.48267, -0.35328),
        ];
        $linestring = new LineString($testCoords);
        $this->assertEquals([
            [-0.12514, 51.51259],
            [-0.01614, 51.51537],
            [-0.06111, 51.48758],
            [-0.35328, 51.48267],
            ], $linestring->exportArray());
    }
}
