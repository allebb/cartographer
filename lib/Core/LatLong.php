<?php

namespace Ballen\Cartographer\Core;

/**
 * Description of LatLng
 *
 * @author ballen
 */
class LatLong extends \Ballen\Distical\Entities\LatLong
{

    /**
     * Create a new latitude and longitude object.
     * @param double $lat The latitude co-ordinate.
     * @param double $lng The longitude co-ordinate.
     */
    public function __construct($lat, $lng)
    {
        parent::__construct($lat, $lng);
    }

    /**
     * Returns a GeoJSON compatible LatLng array in the reversed format.
     * @return array
     */
    public function lngLatArray()
    {
        return [$this->lng(), $this->lat()];
    }
}
