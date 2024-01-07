<?php

namespace TioJobs\AsaasPhp\Endpoints\Charges\Billet;

use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasChargeInterface;
use TioJobs\AsaasPhp\DataTransferObjects\Charges\Billet\DirectBilletDTO;

class DirectChargeByBillet implements AsaasChargeInterface
{
    use HasMode;
    use HasToken;

    public function __construct(
        protected DirectBilletDTO $directBilletDTO,
    ) {
    }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.mode.{$this->getMode()}.url");
        assert(is_string($endpoint));

        return "{$endpoint}/payments";
    }

    /** @return array<string, array<string, string|null>|float|int|string> */
    public function getData(): array
    {
        return [
            "customer" => $this->directBilletDTO->customerId,
            "billingType" => $this->directBilletDTO->billingType->value,
            "value" => $this->directBilletDTO->value,
            "dueDate" => $this->directBilletDTO->dueDate,
        ];
    }

    /**
     * @param array<string,string> $response
     * @return string
     */
    public function getBilletUrl(array $response): string
    {
        return $response['bankSlipUrl'] ?? '';
    }
}
