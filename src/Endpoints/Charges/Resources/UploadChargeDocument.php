<?php

namespace TioJobs\AsaasPhp\Endpoints\Charges\Resources;

use TioJobs\AsaasPhp\Concerns\HasIdAndData;
use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class UploadChargeDocument implements AsaasInterface
{
    use HasIdAndData;
    use HasToken;
    use HasMode;

    public function getPath(): string
    {
        $endpoint = config("asaas-php.environment.{$this->getMode()}.url");
        assert(is_string($endpoint));

        return "{$endpoint}/payments/{$this->id}/documents";
    }

    /** @return array<string,string> */
    public function getData(): array
    {
        return $this->data;
    }
}
