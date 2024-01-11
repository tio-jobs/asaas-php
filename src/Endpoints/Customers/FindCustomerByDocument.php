<?php

namespace TioJobs\AsaasPhp\Endpoints\Customers;

use TioJobs\AsaasPhp\Concerns\HasBlankData;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class FindCustomerByDocument implements AsaasInterface
{
    use HasBlankData;

    public function __construct(
        public readonly string $document,
    ) {
    }

    public function getPath(): string
    {
        return 'customers?cpfCnpj='.sanitize($this->document);
    }
}
