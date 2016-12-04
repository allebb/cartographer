<?php
namespace Ballen\Cartographer;

use Ballen\Cartographer\Core\GeoJSONTypeInterface;
use Ballen\Cartographer\Core\Multipliable;
use Ballen\Cartographer\Core\GeoJSON;

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
class Feature extends GeoJSON implements GeoJSONTypeInterface
{

    /**
     * The GeoJSON schema type
     * @var string
     */
    protected $type = GeoJSON::TYPE_FEATURE;

    /**
     * The Geometry Object
     * @var Multipliable
     */
    private $geometry;

    /**
     * Feature properties array.
     * @param array $geometry
     */
    private $properties;

    public function __construct(Multipliable $geometry, array $properties = [])
    {
        $this->geometry = $geometry;
        $this->properties = $properties;
    }

    /**
     * Exports the type specific schema element(s).
     * @return array
     */
    public function export()
    {
        return [
            'geometry' => $this->geometry->generateMember(),
            'properties' => $this->properties,
        ];
    }

    /**
     * Validate the type specific schema element(s).
     * @return boolean
     */
    public function validate()
    {
        // This schema type is self validating due to the class method type hinting.
        return true;
    }
}
