<?php

namespace TioJobs\AsaasPhp\Endpoints\Customers;

use TioJobs\AsaasPhp\Concerns\HasBlankData;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class RestoreCustomer implements AsaasInterface
{
    use HasBlankData;

    public function __construct(
        public readonly string $id,
    ) {
    }

    public function getPath(): string
    {
        return "customers/{$this->id}/restore";
    }
}
