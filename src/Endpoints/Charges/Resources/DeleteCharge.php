<?php

namespace TioJobs\AsaasPhp\Endpoints\Charges\Resources;

use TioJobs\AsaasPhp\Concerns\HasBlankData;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class DeleteCharge implements AsaasInterface
{
    use HasBlankData;

    public function __construct(
        public readonly string $id,
    ) {
    }

    public function getPath(): string
    {
        return "payments/{$this->id}";
    }
}
