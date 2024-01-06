<?php

namespace TioJobs\AsaasPhp\Endpoints\SubAccounts;

use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasNullableToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;
use TioJobs\AsaasPhp\Enums\FileDocumentTypeEnum;

class UploadDocument implements AsaasInterface
{
    use HasMode;
    use HasNullableToken;

    public function __construct(
        public readonly string $apiKey,
        public readonly string $documentId,
        public readonly FileDocumentTypeEnum $type,
        public readonly array $documentFile,
    ) { }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.mode.{$this->getMode()}.url");

        return "{$endpoint}/myAccount/documents/{$this->documentId}";
    }


    public function getData(): array
    {
        return [
            'type' => $this->type->value,
            $this->documentFile,
        ];
    }
}
