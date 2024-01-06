<?php

namespace TioJobs\AsaasPhp\Endpoints\SubAccounts;

use TioJobs\AsaasPhp\Concerns\HasApiKey;
use TioJobs\AsaasPhp\Concerns\HasBlankData;
use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasNullableToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class GetUploadedDocument implements AsaasInterface
{
    use HasMode;
    use HasBlankData;
    use HasNullableToken;

    public function __construct(
        public readonly string $apiKey,
        public readonly string $documentId,
    ) {
    }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.mode.{$this->getMode()}.url");

        return "{$endpoint}/myAccount/documents/files/{$this->documentId}";
    }
}
