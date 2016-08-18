<?php

namespace Ballen\Cartographer\Core;

use Ballen\Collection\Collection;

class LinearRing
{

    private $rings = [];

    public function addRing(array $coordinates)
    {
        if ($coordinates[0] != $coordinates[(count($coordinates) - 1)]) {
            throw new \InvalidArgumentException('The first and last coordinates must be the same.');
        }
        $this->rings[] = $coordinates;
        return $this;
    }

    public function get()
    {
        return $this->rings;
    }
}
