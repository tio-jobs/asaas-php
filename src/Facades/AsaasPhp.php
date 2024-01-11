<?php

namespace TioJobs\AsaasPhp\Facades;

use Illuminate\Support\Facades\Facade;
use TioJobs\AsaasPhp\Core\Asaas;

/**
 * @method static Asaas make(string $apiKey, string $mode= '')
 */
class AsaasPhp extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'asaas-php';
    }
}
