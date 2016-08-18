<?php

namespace Ballen\Cartographer;

use Ballen\Cartographer\Core\GeoJSONTypeInterface;
use Ballen\Cartographer\Core\Multipliable;
use Ballen\Cartographer\Core\GeoJSON;
use Ballen\Cartographer\Core\LinearRing;
use Ballen\Collection\Collection;

class Polygon extends GeoJSON implements GeoJSONTypeInterface, Multipliable
{

    /**
     * The GeoJSON schema type
     * @var string
     */
    protected $type = GeoJSON::TYPE_POLYGON;

    /**
     * The LinearRing collection
     * @var LinearRing
     */
    private $polygon;

    public function __construct(LinearRing $polygon)
    {
        $this->polygon = $polygon;
    }

    /**
     * Exports the type specific schema element(s).
     * @return array
     */
    public function export()
    {
        return [
            'coordinates' => $this->polygon->get(),
        ];
    }

    /**
     * Export the polygon data as an array.
     * @return array
     */
    public function exportArray()
    {
        return $this->polygon->get();
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
