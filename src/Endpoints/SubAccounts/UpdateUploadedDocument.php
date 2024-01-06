<?php

namespace TioJobs\AsaasPhp\Endpoints\SubAccounts;

use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasNullableToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;
use TioJobs\AsaasPhp\Enums\FileDocumentTypeEnum;

class UpdateUploadedDocument implements AsaasInterface
{
    use HasMode;
    use HasNullableToken;

    public function __construct(
        public readonly string $documentId,

        /** @var array<int,string> */
        public readonly array $documentFile,
        public readonly string $apiKey,
    ) {
    }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.mode.{$this->getMode()}.url");
        assert(is_string($endpoint));

        return "{$endpoint}/myAccount/documents/files/{$this->documentId}";
    }


    public function getData(): array
    {
        return [
            $this->documentFile,
        ];
    }
}
