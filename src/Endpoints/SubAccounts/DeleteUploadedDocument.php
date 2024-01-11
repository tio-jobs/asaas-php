<?php

namespace TioJobs\AsaasPhp\Endpoints\SubAccounts;

use TioJobs\AsaasPhp\Concerns\HasBlankData;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class DeleteUploadedDocument implements AsaasInterface
{
    use HasBlankData;

    public function __construct(
        public readonly string $documentId,
    ) {
    }

    public function getPath(): string
    {
        return "myAccount/documents/files/{$this->documentId}";
    }
}
