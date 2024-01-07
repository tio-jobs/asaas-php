<?php

namespace TioJobs\AsaasPhp\Endpoints\SubAccounts;

use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;
use TioJobs\AsaasPhp\Enums\FileDocumentTypeEnum;

class UploadDocument implements AsaasInterface
{
    use HasMode;
    use HasToken;

    public function __construct(
        public readonly string $apiKey,
        public readonly string $documentId,
        public readonly FileDocumentTypeEnum $type,

        /** @var array<int,string> */
        public readonly array $documentFile,
    ) {
    }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.environment.{$this->getMode()}.url") ?? '';
        assert(is_string($endpoint));

        return "{$endpoint}/myAccount/documents/{$this->documentId}";
    }

    /**
     * @return array{
     *     type: 'CUSTOM'|'ENTREPRENEUR_REQUIREMENT'|'IDENTIFICATION'|'MINUTES_OF_ELECTION'|'SOCIAL_CONTRACT',
     *     0: array<int,string>
     *     }
     */
    public function getData(): array
    {
        return [
            'type' => $this->type->value,
            $this->documentFile,
        ];
    }
}
