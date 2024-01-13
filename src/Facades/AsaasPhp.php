<?php

namespace TioJobs\AsaasPhp\Facades;

use Closure;
use Illuminate\Support\Facades\Facade;
use TioJobs\AsaasPhp\Core\Asaas;
use TioJobs\AsaasPhp\Support\FakeAsaas;

/**
 * @method static Asaas make(string $apiKey = '', string $mode= '')
 * @method static Asaas withKey(string $apiKey, string $mode= '')
 * @mixin Asaas
 * @mixin FakeAsaas
 */
class AsaasPhp extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'asaas-php';
    }

    public static function fake(Closure|array|null $callback = null): void
    {
        static::swap(new FakeAsaas($callback));
    }
}
