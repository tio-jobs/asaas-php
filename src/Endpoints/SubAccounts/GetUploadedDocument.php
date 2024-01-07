<?php

namespace TioJobs\AsaasPhp\Endpoints\SubAccounts;

use TioJobs\AsaasPhp\Concerns\HasApiKey;
use TioJobs\AsaasPhp\Concerns\HasBlankData;
use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class GetUploadedDocument implements AsaasInterface
{
    use HasMode;
    use HasToken;
    use HasBlankData;

    public function __construct(
        public readonly string $apiKey,
        public readonly string $documentId,
    ) {
    }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.mode.{$this->getMode()}.url");
        assert(is_string($endpoint));

        return "{$endpoint}/myAccount/documents/files/{$this->documentId}";
    }
}
