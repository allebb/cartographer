<?php

namespace Ballen\Cartographer;

use Ballen\Cartographer\Core\GeoJSONTypeInterface;
use Ballen\Cartographer\Core\GeoJSON;
use Ballen\Cartographer\Feature;
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
class FeatureCollection extends GeoJSON implements GeoJSONTypeInterface
{

    /**
     * The GeoJSON schema type
     * @var string
     */
    protected $type = GeoJSON::TYPE_FEATURECOLLECTION;

    /**
     * The feature collection (of Feature Objects)
     * @var Collection
     */
    private $features;

    public function __construct($init = null)
    {
        $this->features = new Collection;

        if (is_array($init)) {
            array_walk($init, function($i) {
                if (is_a($i, Feature::class)) {
                    $this->addFeature($i);
                }
            });
        }
    }

    /**
     * Add a new Feature object to the FeatureCollection.
     * @param Feature $geometry
     */
    public function addFeature(Feature $feature)
    {
        $this->features->push($feature);
    }

    /**
     * Exports the type specific schema element(s).
     * @return array
     */
    public function export()
    {
        $features = [];
        foreach ($this->features->all()->toArray() as $feature) {
            $features[] = $feature->generateMember();
        }
        return [
            'features' => $features,
        ];
    }

    /**
     * Validate the type specific schema element(s).
     * @return boolean
     */
    public function validate()
    {
        // FeatureCollection type must have one or more Feature types.
        if ($this->features->count() > 0) {
            return true;
        }
        return false;
    }
}
