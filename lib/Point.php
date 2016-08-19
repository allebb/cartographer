<?php

namespace Ballen\Cartographer;

use Ballen\Cartographer\Core\GeoJSONTypeInterface;
use Ballen\Cartographer\Core\Multipliable;
use Ballen\Cartographer\Core\GeoJSON;
use Ballen\Distical\Entities\LatLong;

class Point extends GeoJSON implements GeoJSONTypeInterface, Multipliable
{

    /**
     * The GeoJSON schema type
     * @var string 
     */
    protected $type = GeoJSON::TYPE_POINT;

    /**
     * The LatLong point for the map.
     * @var LatLong
     */
    private $coordinate;

    /**
     * Create a new instance of the Point GeoJSON schema
     * @param LatLong $coordinate
     */
    public function __construct(LatLong $coordinate)
    {
        $this->coordinate = $coordinate;
    }

    /**
     * Exports the type specific schema element(s).
     * @return array
     */
    public function export()
    {
        return [
            'coordinates' => [
                $this->coordinate->lng(),
                $this->coordinate->lat()      
            ]
        ];
    }

    /**
     * Exports the type specific schema array (for use in MultiX types).
     * @return array
     */
    public function exportArray()
    {
        return [$this->coordinate->lng(), $this->coordinate->lat()];
    }

    /**
     * Validate the type specific schema element(s).
     * @return boolean
     */
    public function validate()
    {
        // No need for additional validation as the class constructor will enforce a single LatLong object.
        return true;
    }
}
