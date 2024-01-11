<?php

namespace TioJobs\AsaasPhp\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use TioJobs\AsaasPhp\Facades\AsaasPhp;
use TioJobs\AsaasPhp\Providers\AsaasPhpServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [AsaasPhpServiceProvider::class];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'AsaasPhp' => AsaasPhp::class,
        ];
    }
}
