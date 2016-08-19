<?php
use Ballen\Cartographer\LineString;
use Ballen\Cartographer\Feature;
use Ballen\Cartographer\FeatureCollection;
use Ballen\Distical\Entities\LatLong;

class FeatureCollectionTest extends PHPUnit_Framework_TestCase
{

    private $collection;
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
        $this->collection = new FeatureCollection([$this->geometry]);
        //$this->collection->addFeature();

        parent::setUp();
    }

    public function testFeatureCollectionGenerate()
    {
        $this->assertEquals('{"type":"FeatureCollection","features":[{"type":"Feature","geometry":{"type":"LineString","coordinates":[[1.045057,52.0057],[1.045329,52.005651],[1.045709,52.005521],[1.046035,52.005348],[1.046356,52.005262],[1.046561,52.005181],[1.04686,52.005074],[1.047102,52.005038],[1.047338,52.005029],[1.047543,52.005042],[1.047982,52.005103],[1.048789,52.005257]]},"properties":{"name":"A test feature","link":"http:\/\/example.com"}}]}', $this->collection->generate());
    }

    public function testFeatureCollectionValidationFailure()
    {
        $this->setExpectedException(\Ballen\Cartographer\Exceptions\TypeSchemaValidationException::class);
        $emptyCollection = new FeatureCollection();
        $emptyCollection->generate();
    }
}
