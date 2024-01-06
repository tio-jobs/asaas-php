<?php

namespace TioJobs\AsaasPhp\Facades;

use Illuminate\Support\Facades\Facade;

class AsaasPhp extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'asaas-php';
    }
}
