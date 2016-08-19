<?php
use Ballen\Cartographer\LineString;
use Ballen\Cartographer\Feature;
use Ballen\Distical\Entities\LatLong;

class FeatureTest extends PHPUnit_Framework_TestCase
{

    private $geometry;
    private $properties = [
        'name' => 'A test feature',
        'link' => 'http://example.com'
    ];
    private $linestringCoords;

    public function setUp()
    {
        // Setup a test LineString object.
        $this->linestringCoords = [
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
        $this->geometry = new Feature(new LineString($this->linestringCoords), $this->properties);

        parent::setUp();
    }

    public function testFeatureExport()
    {
        $exported = json_decode(json_encode($this->geometry->generateMember()), true);
        $this->assertEquals([
            'geometry' => $exported['geometry'],
            'properties' => $this->properties,
            ], $this->geometry->export());
    }

    public function testFeatureGenerate()
    {
        $this->assertEquals('{"type":"Feature","geometry":{"type":"LineString","coordinates":[[1.045057,52.0057],[1.045329,52.005651],[1.045709,52.005521],[1.046035,52.005348],[1.046356,52.005262],[1.046561,52.005181],[1.04686,52.005074],[1.047102,52.005038],[1.047338,52.005029],[1.047543,52.005042],[1.047982,52.005103],[1.048789,52.005257]]},"properties":{"name":"A test feature","link":"http:\/\/example.com"}}', $this->geometry->generate());
    }
}
