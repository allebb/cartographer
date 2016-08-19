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
interface Multipliable
{

    /**
     * Method to export a single array (to enable multiple type export)
     */
    public function exportArray();
}
