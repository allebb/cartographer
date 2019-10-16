<?php
/**
 * PHPUNIT BOOTSTRAP FILE USED TO LOAD THE COMPOSER AUTOLOADER SO WE CAN
 * UTILISE THE PACKAGE CLASSES IN THE TEST CLASSES.
 */


// Sets the PHP precision to match our testing environment requirements.
ini_set('precision', 10);

require __DIR__ . '/vendor/autoload.php';
