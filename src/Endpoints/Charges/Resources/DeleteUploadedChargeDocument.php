<?php

namespace TioJobs\AsaasPhp\Endpoints\Charges\Resources;

use TioJobs\AsaasPhp\Concerns\HasBlankData;
use TioJobs\AsaasPhp\Concerns\HasIdAndDocument;
use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class DeleteUploadedChargeDocument implements AsaasInterface
{
    use HasIdAndDocument;
    use HasToken;
    use HasMode;
    use HasBlankData;

    public function getPath(): string
    {
        $endpoint = config("asaas-php.environment.{$this->getMode()}.url");
        assert(is_string($endpoint));

        return "{$endpoint}/payments/{$this->id}/documents/{$this->document}";
    }
}
