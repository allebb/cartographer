<?php

use Ballen\Cartographer\Polygon;
use Ballen\Cartographer\Core\LinearRing;
use PHPUnit\Framework\TestCase;

class PolygonTest extends TestCase
{

    private $geojson;

    public function setUp(): void
    {
        $this->geojson = json_decode(
            '{"type":"Polygon","coordinates":[[[-109.0283203125,36.98500309285596],[-109.0283203125,40.97989806962013],[-102.06298828125,40.97989806962013],[-102.06298828125,37.00255267215955],[-109.0283203125,36.98500309285596]]]}',
            true
        );
    }

    public function testGeneratesPolygon()
    {
        $linearRing = new LinearRing();
        foreach ($this->geojson['coordinates'] as $poly) {
            $linearRing->addRing($poly);
        }
        $polygon = new Polygon($linearRing);
        $this->assertEquals(
            '{"type":"Polygon","coordinates":[[[-109.0283203125,36.98500309285596],[-109.0283203125,40.97989806962013],[-102.06298828125,40.97989806962013],[-102.06298828125,37.00255267215955],[-109.0283203125,36.98500309285596]]]}',
            $polygon->generate()
        );
    }

    public function testExportPolygonArray()
    {
        $linearRing = new LinearRing();
        foreach ($this->geojson['coordinates'] as $poly) {
            $linearRing->addRing($poly);
        }
        $polygon = new Polygon($linearRing);
        $this->assertEquals($this->geojson['coordinates'], $polygon->exportArray());
    }
}
