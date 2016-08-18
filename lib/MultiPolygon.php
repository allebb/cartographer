<?php

namespace Ballen\Cartographer;

use Ballen\Cartographer\Core\GeoJSON;
use Ballen\Distical\Entities\LatLong;
use Ballen\Cartographer\Polygon;
use Ballen\Collection\Collection;

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
            array_walk($init, function($i) {
                if (is_a($i, Polygon::class)) {
                    $this->addPolygon($i);
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

        foreach ($this->polygons->all()->toArray() as $p) {
            $polygons[] = $p->exportArray();
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
