<?php
namespace Ballen\Cartographer;

use Ballen\Cartographer\Core\GeoJSON;
use Ballen\Cartographer\Polygon;
use Ballen\Collection\Collection;

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
class MultiPolygon extends GeoJSON
{

    /**
     * The GeoJSON schema type
     * @var string 
     */
    protected $type = GeoJSON::TYPE_MULTIPOLYGON;

    /**
     * The collection of Polygon objects.
     * @var Collection
     */
    private $polygons;

    /**
     * Create a new instance of the MultiPolygon GeoJSON schema
     * @param array $linestrings
     */
    public function __construct($init = null)
    {
        $this->polygons = new Collection;

        if (is_array($init)) {
            array_walk($init, function($item) {
                if (is_a($item, Polygon::class)) {
                    $this->addPolygon($item);
                }
            });
        }
    }

    /**
     * Add a new Polygon object collection.
     * @param \Ballen\Cartographer\Polygon $polygon
     * @return \Ballen\Cartographer\MultiPolygon
     */
    public function addPolygon(Polygon $polygon)
    {
        $this->polygons->push($polygon);
        return $this;
    }

    /**
     * Exports the type specific schema element(s).
     * @return array
     */
    public function export()
    {
        $polygons = [];

        foreach ($this->polygons->all()->toArray() as $polygon) {
            $polygons[] = $polygon->exportArray();
        }
        return [
            'coordinates' => $polygons,
        ];
    }

    /**
     * Validate the type specific schema element(s).
     * @return boolean
     */
    public function validate()
    {
        return true;
    }
}
