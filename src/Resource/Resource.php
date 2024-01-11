<?php

declare(strict_types=1);

namespace TioJobs\AsaasPhp\Resource;

use TioJobs\AsaasPhp\Core\Asaas;

abstract class Resource
{
    public function __construct(protected Asaas $asaas)
    {
        //
    }
}
