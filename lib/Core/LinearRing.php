<?php

namespace Ballen\Cartographer\Core;

use Ballen\Collection\Collection;

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
