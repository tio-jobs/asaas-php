<?php

namespace TioJobs\AsaasPhp\Endpoints\Charges\Resources;

use TioJobs\AsaasPhp\Concerns\HasBlankData;
use TioJobs\AsaasPhp\Concerns\HasIdAndDocument;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class DeleteUploadedChargeDocument implements AsaasInterface
{
    use HasBlankData;
    use HasIdAndDocument;

    public function getPath(): string
    {
        return "payments/{$this->id}/documents/{$this->document}";
    }
}
