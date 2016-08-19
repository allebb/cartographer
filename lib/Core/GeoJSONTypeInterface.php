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
interface GeoJSONTypeInterface
{

    /**
     * Method to export the Type schema to the parent GeoJSON object.
     */
    public function export();

    /**
     * Local Type validation to ensure that the Type Schema validates accordingly.
     */
    public function validate();
}
