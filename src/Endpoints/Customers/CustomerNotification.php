<?php

namespace TioJobs\AsaasPhp\Endpoints\Customers;

use TioJobs\AsaasPhp\Concerns\HasBlankData;
use TioJobs\AsaasPhp\Concerns\HasId;
use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class CustomerNotification implements AsaasInterface
{
    use HasId;
    use HasMode;
    use HasToken;
    use HasBlankData;

    public function getPath(): string
    {
        $endpoint = config("asaas-php.mode.{$this->getMode()}.url");
        assert(is_string($endpoint));

        return "{$endpoint}/customers/{$this->id}/notifications";
    }
}
