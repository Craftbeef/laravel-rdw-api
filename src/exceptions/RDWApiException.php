<?php
namespace Craftbeef\LaravelRdwApi\exceptions;
use Exception;

class RDWApiException extends Exception
{
    public function __construct()
    {
        parent::__construct('An error occurred while fetching data from the RDW API');
    }
}
