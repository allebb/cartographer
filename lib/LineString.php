<?php namespace Ballen\Cartographer;

use Ballen\Cartographer\Core\GeoJSON;
use Ballen\Distical\Entities\LatLong;
use Ballen\Collection\Collection;

class LineString extends GeoJSON
{

    /**
     * The GeoJSON schema type
     * @var string
     */
    protected $type = GeoJSON::TYPE_LINESTRING;

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
            array_walk($init, function($i) {
                if (is_a($i, LatLong::class)) {
                    $this->addCoordinate($i);
                }
            });
        }
    }

    /**
     * Add a new coordinate to the LineString seqence.
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
        foreach ($this->coordinates->all()->toArray() as $c) {
            $coords[] = [$c->lat(), $c->lng()];
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
        // LineString Type must have two or more coordinates.
        if ($this->coordinates->count() < 2) {
            return false;
        }

        return true;
    }
}
