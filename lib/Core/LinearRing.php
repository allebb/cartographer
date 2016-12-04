<?php
namespace Ballen\Cartographer\Core;

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
class LinearRing
{

    private $rings = [];

    /**
     * Add a coordinate group to the object.
     * @param array $coordinates
     * @return \Ballen\Cartographer\Core\LinearRing
     * @throws \InvalidArgumentException
     */
    public function addRing(array $coordinates)
    {
        //die(var_dump((count($coordinates) - 1)));
        if ($coordinates[0] != $coordinates[(count($coordinates) - 1)]) {
            throw new \InvalidArgumentException('The first and last coordinates must be the same.');
        }
        $this->rings[] = $coordinates;
        return $this;
    }

    /**
     * Returns the array of groups
     * @return array
     */
    public function get()
    {
        return $this->rings;
    }
}
