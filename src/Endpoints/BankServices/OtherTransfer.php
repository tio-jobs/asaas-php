<?php

namespace TioJobs\AsaasPhp\Endpoints\BankServices;

use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;
use TioJobs\AsaasPhp\DataTransferObjects\BankServices\BankAccountDTO;
use TioJobs\AsaasPhp\Enums\OperationTypeEnum;
use TioJobs\AsaasPhp\Enums\PixTypeEnum;

class OtherTransfer implements AsaasInterface
{
    public function __construct(
        public readonly float $value,
        public readonly OperationTypeEnum $operationTypeEnum,
        public readonly ?BankAccountDTO $bankAccountDTO = null,
        public readonly ?string $pixKey = null,
        public readonly ?PixTypeEnum $pixTypeEnum = null,
        public readonly ?string $descriptionForPix = null,
        public readonly ?string $scheduleDate = null,
    ) {
    }

    public function getPath(): string
    {
        return 'transfers';
    }

    /** @return array<string, array<string, array<string, string>|string>|float|string|null> */
    public function getData(): array
    {

        $data = ['value' => $this->value];

        if (! is_null($this->bankAccountDTO)) {
            $bankData = [
                'bankAccount' => [
                    'bank' => [
                        'code' => $this->bankAccountDTO->bankCode,
                    ],
                    'ownerName' => $this->bankAccountDTO->ownerName,
                    'cpfCnpj' => $this->bankAccountDTO->document,
                    'agency' => $this->bankAccountDTO->agency,
                    'account' => $this->bankAccountDTO->accountNumber,
                    'accountDigit' => $this->bankAccountDTO->accountDigit,
                    'bankAccountType' => $this->bankAccountDTO->bankAccountTypeEnum->value,
                ],
            ];

            $data = array_merge($data, $bankData);
        }

        if (! is_null($this->pixKey) && $this->operationTypeEnum->value === 'PIX') {
            $pixData = [
                'pixAddressKey' => $this->pixKey,
                'pixAddressKeyType' => $this->pixTypeEnum?->value,
                'description' => $this->descriptionForPix,
            ];

            $data = array_merge($data, $pixData);
        }

        $otherData = [
            'operationType' => $this->operationTypeEnum->value,
            'scheduleData' => $this->scheduleDate,
        ];

        return array_merge($data, $otherData);
    }
}
