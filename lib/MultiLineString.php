<?php

namespace Ballen\Cartographer;

use Ballen\Cartographer\Core\GeoJSON;
use Ballen\Cartographer\Core\GeoJSONTypeInterface;
use Ballen\Cartographer\LineString;
use Ballen\Distical\Entities\LatLong;
use Ballen\Collection\Collection;

class MultiLineString extends GeoJSON implements GeoJSONTypeInterface
{

    /**
     * The GeoJSON schema type
     * @var string 
     */
    protected $type = GeoJSON::TYPE_MULTILINESTRING;

    /**
     * The collection of LineString objects.
     * @var Collection
     */
    private $linestrings;

    /**
     * Create a new instance of the MultiPointString GeoJSON schema
     * @param array $linestrings
     */
    public function __construct($init)
    {
        $this->linestrings = new Collection;

        if (is_array($init)) {
            array_walk($init, function($i) {
                if (is_a($i, LineString::class)) {
                    $this->addLineString($i);
                }
            });
        }
    }

    /**
     * Add a new LineString object collection.
     * @param LineString $linestring
     */
    public function addLineString(LineString $linestring)
    {
        $this->linestrings->push($linestring);
    }

    /**
     * Exports the type specific schema element(s).
     * @return array
     */
    public function export()
    {
        $linestrings = [];
        
        foreach ($this->linestrings->all()->toArray() as $l) {
            $linestrings[] = $l->exportArray();
        }
        return [
            'coordinates' => $linestrings,
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
