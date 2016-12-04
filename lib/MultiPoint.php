<?php
namespace Ballen\Cartographer;

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
 * @link https://github.com/allebb/cartographer
 * @link http://bobbyallen.me
 *
 */
class MultiPoint extends GeoJSON
{

    /**
     * The GeoJSON schema type
     * @var string
     */
    protected $type = GeoJSON::TYPE_MULTIPOINT;

    /**
     * The coordinates collection (of LatLong objects)
     * @var Collection
     */
    private $coordinates;

    /**
     * 
     */
    public function __construct($init)
    {
        $this->coordinates = new Collection;

        if (is_array($init)) {
            array_walk($init, function($item) {
                if (is_a($item, LatLong::class)) {
                    $this->addCoordinate($item);
                }
            });
        }
    }

    /**
     * Add a new coordinate to the LineString sequence.
     * @param LatLong $coordinate
     */
    public function addCoordinate(LatLong $coordinate)
    {
        $this->coordinates->push($coordinate);
    }

    /**
     * Exports the type specific schema element(s).
     * @return array
     */
    public function export()
    {
        $coords = [];
        foreach ($this->coordinates->all()->toArray() as $coord) {
            $coords[] = $coord->lngLatArray();
        }

        return [
            'coordinates' => $coords,
        ];
    }

    /**
     * Validate the type specific schema element(s).
     * @return boolean
     */
    public function validate()
    {
        // MultiPoint Type can have one or more lat/lng coordinates.
        if ($this->coordinates->count() < 1) {
            return false;
        }
        return true;
    }
}
