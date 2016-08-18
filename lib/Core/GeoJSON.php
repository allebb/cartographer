<?php namespace Ballen\Cartographer\Core;

use Ballen\Cartographer\Exceptions\InvalidObjectTypeException;

abstract class GeoJSON
{

    const TYPE_POINT = "Point";
    const TYPE_MULTIPOINT = "MultiPoint";
    const TYPE_LINESTRING = "LineString";
    const TYPE_MULTILINESTRING = "MultiLineString";
    const TYPE_POLYGON = "Polygon";
    const TYPE_MULTIPOLYGON = "MultiPolygon";
    const TYPE_GEOMETRYCOLLECTION = "GeometryCollection";
    const TYPE_FEATURE = "Feature";
    const TYPE_COLLECTION = "FeatureCollection";

    /**
     * The GeoJSON Object Type
     * @var string
     */
    protected $type;

    /**
     * Generates the GeoJSON object.
     */
    public function generate()
    {
        $this->validate();
    }

    /**
     * Validates the data and schema type requirements.
     * @throws InvalidObjectTypeException
     */
    private function validate()
    {

        $type_constants = (new \ReflectionClass)->getConstants();
        var_dump($type_constants);
        if (!in_array($this->type, $type_constants)) {
            throw new InvalidObjectTypeException(sprintf('The GeoJSON object type specified (%s) is not supported.', $this->type));
        }
    }
}
