<?php namespace Ballen\Cartographer\Core;

abstract class GeoJSON implements GeoJSONTypeInterface
{

    /**
     * Supported GeoJSON types.
     */
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
        $this->validateSchema();
    }

    /**
     * Validates the GeoJSON schema.
     * @throws InvalidObjectTypeException
     */
    private function validateSchema()
    {

        $type_constants = (new \ReflectionClass(__CLASS__))->getConstants();
        if (!in_array($this->type, $type_constants)) {
            throw new \Ballen\Cartographer\Exceptions\InvalidObjectTypeException(sprintf('The GeoJSON object type specified (%s) is not supported.', $this->type));
        }
        if (!$this->validate()) {
            throw new \Ballen\Cartographer\Exceptions\TypeSchemaValidationException('The GeoJSON type object failed to validate.');
        }
    }
}
