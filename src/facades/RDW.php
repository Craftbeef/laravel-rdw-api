<?php

namespace Craftbeef\LaravelRdwApi\facades;

use Craftbeef\LaravelRdwApi\LaravelRDWApi;
use Illuminate\Support\Facades\Facade;

class RDW extends Facade
{
    protected static function getFacadeAccessor()
    {
        return LaravelRDWApi::class;
    }
}