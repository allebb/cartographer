<?php namespace Ballen\Cartographer\Core;

interface GeoJSONTypeInterface
{

    /**
     * Method to export the Type schema to the parent GeoJSON object.
     */
    public function export();

    /**
     * Local Type validation to ensure that the Type Schema validates accordingly.
     */
    public function validateType();
}
