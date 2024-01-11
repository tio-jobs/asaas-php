<?php

namespace TioJobs\AsaasPhp\Endpoints\BankServices;

use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class TransferToAsaas implements AsaasInterface
{
    public function __construct(
        public readonly float $value,
        public readonly string $walletId,
    ) {
    }

    public function getPath(): string
    {
        return 'transfers';
    }

    /** @return array<string, float|string> */
    public function getData(): array
    {

        return [
            'value' => $this->value,
            'walletId' => $this->walletId,
        ];
    }
}
