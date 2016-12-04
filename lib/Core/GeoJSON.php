<?php
namespace Ballen\Cartographer\Core;

/**
 * Cartographer
 *
 * Cartographer is a PHP library providing the ability to programmatically
 * generate GeoJSON objects.
 *
 * @author Bobby Allen <ballen@bobbyallen.me>
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/allebb/cartographer
 * @link http://bobbyallen.me
 *
 */
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
    const TYPE_FEATURECOLLECTION = "FeatureCollection";

    /**
     * The GeoJSON Object Type
     * @var string
     */
    protected $type;

    /**
     * Generates the GeoJSON object.
     * @return string
     */
    public function generate()
    {
        $this->validateSchema();
        return $this->buildJson();
    }

    /**
     * Generate a GeometryCollection member GeoJSON object.
     * @return array
     */
    public function generateMember()
    {
        return array_merge(['type' => $this->type], $this->export());
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

    /**
     * Constructs the JSON object.
     * @return string
     */
    private function buildJson($pretty = false)
    {
        $data = array_merge(['type' => $this->type], $this->export());
        return json_encode($data);
    }
}
