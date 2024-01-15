<?php

use TioJobs\AsaasPhp\Core\Asaas;
use TioJobs\AsaasPhp\Tests\TestCase;
use GuzzleHttp\Promise\PromiseInterface;

uses(
    TestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
)->in('Feature');

require_once('Concerns/Factories.php');

function asaasPhp(?string $apiKey = null, string $mode = 'sandbox'): Asaas
{
    if(config('asaas-php.allow_sub_accounts')) {
        return new Asaas((string) $apiKey, $mode);
    }

    return new Asaas($apiKey ?? config('asaas-php.environment.sandbox.key'), $mode);
}

function fakeResponse(array|null|string $body = null, int $status = 200, array $headers = []): PromiseInterface
{
    return asaasPhp()->response($body, $status, $headers);
}

function fixture(string $path): array
{
    $path = str_replace(['/', '.php'], [DIRECTORY_SEPARATOR, ''], __DIR__ . '/Fixtures/' . $path) . '.php';

    return include $path;
}

function onlyWithSandboxApi()
{
    if (FakeApi()) {
        test()->markTestSkipped('Only runs with Asaas API [ACCESS_ASAAS_API=true]');
    }
}

function FakeApi(): bool
{
    return (bool) env('ACCESS_ASAAS_API') === false;
}
