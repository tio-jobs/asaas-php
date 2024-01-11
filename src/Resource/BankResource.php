<?php

declare(strict_types=1);

namespace TioJobs\AsaasPhp\Resource;

use TioJobs\AsaasPhp\DataTransferObjects\BankServices\BankAccountDTO;
use TioJobs\AsaasPhp\Endpoints\BankServices\GetAllTransfers;
use TioJobs\AsaasPhp\Endpoints\BankServices\GetBankStatement;
use TioJobs\AsaasPhp\Endpoints\BankServices\GetTransfer;
use TioJobs\AsaasPhp\Endpoints\BankServices\OtherTransfer;
use TioJobs\AsaasPhp\Endpoints\BankServices\TransferToAsaas;
use TioJobs\AsaasPhp\Enums\OperationTypeEnum;
use TioJobs\AsaasPhp\Enums\PixTypeEnum;

class BankResource extends Resource
{
    /**
     * @return array<string, mixed>
     */
    public function getAllTransfers(): array
    {
        return $this->asaas->get(new GetAllTransfers());
    }

    /**
     * @return array<string, mixed>
     */
    public function getStatement(?string $startDate = null, ?string $endDate = null, int $offset = 0, int $limit = 10): array
    {
        return $this->asaas->get(new GetBankStatement($startDate, $endDate, $offset, $limit));
    }

    /**
     * @return array<string, mixed>
     */
    public function getTransfer(string $transferId): array
    {
        return $this->asaas->get(new GetTransfer($transferId));
    }

    /**
     * @return array<string, mixed>
     */
    public function otherTransfer(float $value, OperationTypeEnum $operationTypeEnum, ?BankAccountDTO $bankAccountDTO = null, ?string $pixKey = null, ?PixTypeEnum $pixTypeEnum = null, ?string $descriptionForPix = null, ?string $scheduleDate = null): array
    {
        return $this->asaas->post(new OtherTransfer($value, $operationTypeEnum, $bankAccountDTO, $pixKey, $pixTypeEnum, $descriptionForPix, $scheduleDate));
    }

    /**
     * @return array<string, mixed>
     */
    public function transferToAsaas(float $value, string $walletId): array
    {
        return $this->asaas->post(new TransferToAsaas($value, $walletId));
    }
}
