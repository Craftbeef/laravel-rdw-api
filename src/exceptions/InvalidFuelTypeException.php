<?php

namespace Craftbeef\LaravelRdwApi\exceptions;

use Exception;

class InvalidFuelTypeException extends Exception
{
    public function __construct()
    {
        parent::__construct('
        The entered fuel type is invalid
        valid fuel types are: Diesel, Benzine, Elektriciteit, LPG, Waterstof, LNG, Alcohol, CNG
        ');
    }
}