<?php

namespace TioJobs\AsaasPhp\Endpoints\Charges\Resources;

use TioJobs\AsaasPhp\Concerns\HasBlankData;
use TioJobs\AsaasPhp\Concerns\HasIdAndDocument;
use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class DeleteUploadedChargeDocument implements AsaasInterface
{
    use HasToken;
    use HasMode;
    use HasBlankData;

    public function __construct(
        public readonly string $apiKey,
        public readonly string $id,
        public readonly string $document,
    ) {
    }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.environment.{$this->getMode()}.url");
        assert(is_string($endpoint));

        return "{$endpoint}/payments/{$this->id}/documents/{$this->document}";
    }
}
