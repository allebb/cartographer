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
 * @link https://github.com/bobsta63/cartographer
 * @link http://www.bobbyallen.me
 *
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
