<?php

namespace TioJobs\AsaasPhp\Endpoints\SubAccounts;

use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class UpdateUploadedDocument implements AsaasInterface
{
    public function __construct(
        public readonly string $documentId,

        /** @var array<int,string> */
        public readonly array $documentFile,
    ) {
    }

    public function getPath(): string
    {
        return "myAccount/documents/files/{$this->documentId}";
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
