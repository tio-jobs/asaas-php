<?php

namespace TioJobs\AsaasPhp\Endpoints\Charges\Billet;

use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasNullableToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasChargeInterface;
use TioJobs\AsaasPhp\DataTransferObjects\Charges\Billet\DirectBilletDTO;

class DirectChargeByBillet implements AsaasChargeInterface
{
    use HasMode;
    use HasNullableToken;

    public function __construct(
        protected DirectBilletDTO $directBilletDTO,
    )
    {
    }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.mode.{$this->getMode()}.url");

        return "{$endpoint}/payments";
    }

    public function getData(): array
    {
        return [
            "customer" => $this->directBilletDTO->customerId,
            "billingType" => $this->directBilletDTO->billingType->value,
            "value" => $this->directBilletDTO->value,
            "dueDate" => $this->directBilletDTO->dueDate,
        ];
    }

    public function getBilletUrl(array $response): string
    {
        return $response['bankSlipUrl'] ?? '';
    }
}
