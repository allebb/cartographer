<?php
use Ballen\Cartographer\Polygon;
use Ballen\Cartographer\Core\LinearRing;

class PolygonTest extends PHPUnit_Framework_TestCase
{

    private $geojson;

    public function setUp()
    {
        $this->geojson = json_decode('{"type":"Polygon","coordinates":[[[-109.0283203125,36.98500309285596],[-109.0283203125,40.97989806962013],[-102.06298828125,40.97989806962013],[-102.06298828125,37.00255267215955],[-109.0283203125,36.98500309285596]]]}', true);
    }

    public function testGeneratesPolygon()
    {

        $linearRing = new LinearRing();
        foreach ($this->geojson['coordinates'] as $poly) {
            $linearRing->addRing($poly);
        }
        $polygon = new Polygon($linearRing);
        $this->assertEquals('{"type":"Polygon","coordinates":[[[-109.0283203125,36.985003092856],[-109.0283203125,40.97989806962],[-102.06298828125,40.97989806962],[-102.06298828125,37.00255267216],[-109.0283203125,36.985003092856]]]}', $polygon->generate());
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
