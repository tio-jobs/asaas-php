<?php

namespace TioJobs\AsaasPhp\Endpoints\BankServices;

use TioJobs\AsaasPhp\Concerns\HasBlankData;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class GetTransfer implements AsaasInterface
{
    use HasBlankData;

    public function __construct(
        public readonly string $transferId,
    ) {
    }

    public function getPath(): string
    {
        return "transfers/{$this->transferId}";
    }
}
