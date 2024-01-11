<?php

declare(strict_types=1);

namespace TioJobs\AsaasPhp\Core;

use Exception;
use TioJobs\AsaasPhp\Concerns\HasClient;
use TioJobs\AsaasPhp\Resource\BankResource;
use TioJobs\AsaasPhp\Resource\ChargeResource;
use TioJobs\AsaasPhp\Resource\CustomerResource;
use TioJobs\AsaasPhp\Resource\NotificationResource;
use TioJobs\AsaasPhp\Resource\SubAccountResource;

class Asaas
{
    use HasClient;


    public function __construct(public string $apiKey = '', public string $mode = '')
    {
        $this->injectApiKey();
    }

    public function customer(): CustomerResource
    {
        return new CustomerResource($this);
    }

    public function bank(): BankResource
    {
        return new BankResource($this);
    }

    public function charge(): ChargeResource
    {
        return new ChargeResource($this);
    }

    public function notifications(): NotificationResource
    {
        return new NotificationResource($this);
    }

    public function subAccount(): SubAccountResource
    {
        return new SubAccountResource($this);
    }
}
