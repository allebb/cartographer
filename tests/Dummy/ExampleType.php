<?php

class ExampleType extends \Ballen\Cartographer\Core\GeoJSON implements \Ballen\Cartographer\Core\GeoJSONTypeInterface
{

    public $type = "aninvalidtype";

    public function generate()
    {
        // Don't need anything here, just used to first the invalid type exception.
    }

    public function export()
    {
        // Don't need anything here, just used to first the invalid type exception.
    }

    public function validate()
    {
        
    }
}
