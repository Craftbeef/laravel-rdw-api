<?php
namespace Craftbeef\LaravelRdwApi\exceptions;
use Exception;

class InvalidEndPointException extends Exception
{
    public function __construct()
    {
        parent::__construct('The entered endpoint is invalid ');
    }
}
