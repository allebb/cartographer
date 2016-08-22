<?php

namespace Ballen\Cartographer;

use Ballen\Cartographer\Core\GeoJSONTypeInterface;
use Ballen\Cartographer\Core\GeoJSON;
use Ballen\Cartographer\Core\LatLong;
use Ballen\Collection\Collection;

/**
 * Cartographer
 *
 * Cartographer is a PHP library providing the ability to programmatically
 * generate GeoJSON objects.
 *
 * @author Bobby Allen <ballen@bobbyallen.me>
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/bobsta63/cartographer
 * @link http://www.bobbyallen.me
 *
 */
class GeometryCollection extends GeoJSON implements GeoJSONTypeInterface
{
    /**
     * The GeoJSON schema type
     * @var string
     */
    protected $type = GeoJSON::TYPE_GEOMETRYCOLLECTION;

    /**
     * The geometries collection (of Geomerty Objects)
     * @var Collection
     */
    private $geometries;

    public function __construct($init = [])
    {
        $this->geometries = new Collection;

        if (is_array($init)) {
            array_walk($init, function($i) {
                if (is_a($i, GeoJSONTypeInterface::class)) {
                    $this->addGeometry($i);
                }
            });
        }
    }

    /**
     * Add a new geometry object to the GeometryCollection.
     * @param GeoJSONTypeInterface $geometry
     */
    public function addGeometry(GeoJSONTypeInterface $geometry)
    {
        $this->geometries->push($geometry);
    }

    /**
     * Exports the type specific schema element(s).
     * @return array
     */
    public function export()
    {
        $geometries = [];
        foreach($this->geometries->all()->toArray() as $gemometry){
            $geometries[] = $gemometry->generateMember();
        }
        return [
            'geometries' => $geometries,
        ];
    }

    /**
     * Validate the type specific schema element(s).
     * @return boolean
     */
    public function validate()
    {
        // GeometryCollection type must have one or more geometry type.
        if ($this->geometries->count() > 0) {
            return true;
        }
        return false;
    }
}
