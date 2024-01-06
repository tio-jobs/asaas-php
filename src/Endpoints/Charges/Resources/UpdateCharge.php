<?php

namespace TioJobs\AsaasPhp\Endpoints\Charges\Resources;

use TioJobs\AsaasPhp\Concerns\HasIdAndData;
use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class UpdateCharge implements AsaasInterface
{
    use HasIdAndData;
    use HasMode;

    public function getPath(): string
    {
        $endpoint = config("asaas-php.mode.{$this->getMode()}.url");
        assert(is_string($endpoint));

        return "{$endpoint}/payments/{$this->id}";
    }

    public function getData(): array
    {
        return $this->data;
    }
}
