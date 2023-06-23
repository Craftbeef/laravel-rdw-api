<?php

namespace Craftbeef\LaravelRdwApi\facades;

use Illuminate\Support\Facades\Facade;

class RDWFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'RDW';
    }
}