<?php

namespace TioJobs\AsaasPhp\Endpoints\SubAccounts;

use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;
use TioJobs\AsaasPhp\Enums\FileDocumentTypeEnum;

class UpdateUploadedDocument implements AsaasInterface
{
    use HasMode;
    use HasToken;

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


    /**
     * @return array<int, array<int,string>>
     */
    public function getData(): array
    {
        return [
            $this->documentFile,
        ];
    }
}
