<?php

namespace TioJobs\AsaasPhp\Endpoints\SubAccounts;

use TioJobs\AsaasPhp\Concerns\HasApiKey;
use TioJobs\AsaasPhp\Concerns\HasBlankData;
use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class CheckPendingDocuments implements AsaasInterface
{
    use HasMode;
    use HasToken;
    use HasBlankData;

    public function __construct(
        protected readonly string $apiKey,
    ) {
    }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.mode.{$this->getMode()}.url");
        assert(is_string($endpoint));

        return "{$endpoint}/myAccount/documents";
    }
}
