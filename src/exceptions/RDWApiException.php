<?php
namespace Craftbeef\LaravelRdwApi\exceptions;
use Exception;

class RDWApiException extends Exception
{
    public function __construct($code = 0, $message = 'An error occurred while fetching data from the RDW API')
    {
        parent::__construct($message, $code);
    }
}
