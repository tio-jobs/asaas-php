<?php

namespace TioJobs\AsaasPhp\Endpoints\BankServices;

use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasNullableToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;
use TioJobs\AsaasPhp\DataTransferObjects\BankServices\BankAccountDTO;
use TioJobs\AsaasPhp\Enums\OperationTypeEnum;
use TioJobs\AsaasPhp\Enums\PixTypeEnum;

class TransferToAsaas implements AsaasInterface
{
    use HasMode;
    use HasNullableToken;

    public function __construct(
        public readonly string            $apiKey,
        public readonly float             $value,
        public readonly string $walletId,
    )
    {
    }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.mode.{$this->getMode()}.url");

        return "{$endpoint}/transfers";
    }


    public function getData(): array
    {

        return [
            'value' => $this->value,
            'walletId' => $this->walletId,
        ];
    }
}
