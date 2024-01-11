<?php

namespace TioJobs\AsaasPhp\Endpoints\Customers;

use TioJobs\AsaasPhp\Concerns\HasBlankData;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class ListCustomers implements AsaasInterface
{
    use HasBlankData;

    public function getPath(): string
    {
        return 'customers';
    }
}
