<?php
namespace Craftbeef\LaravelRdwApi\exceptions;
use Exception;

class InvalidVehicleLicenseException extends Exception
{
    public function __construct()
    {
        parent::__construct('The entered license plate is invalid ');
    }
}
