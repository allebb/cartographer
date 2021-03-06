<?php
namespace Ballen\Cartographer;

use Ballen\Cartographer\Core\GeoJSON;
use Ballen\Cartographer\Core\GeoJSONTypeInterface;
use Ballen\Cartographer\LineString;
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
     */
    public function __construct($init = [])
    {
        $this->linestrings = new Collection;

        if (is_array($init)) {
            array_walk($init, function($item) {
                if (is_a($item, LineString::class)) {
                    $this->addLineString($item);
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

        foreach ($this->linestrings->all()->toArray() as $linestring) {
            $linestrings[] = $linestring->exportArray();
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
        if ($this->linestrings->count() < 2) {
            return false;
        }
        return true;
    }
}
