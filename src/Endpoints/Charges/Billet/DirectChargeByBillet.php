<?php

namespace TioJobs\AsaasPhp\Endpoints\Charges\Billet;

use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;
use TioJobs\AsaasPhp\DataTransferObjects\Charges\Billet\DirectBilletDTO;

class DirectChargeByBillet implements AsaasInterface
{
    public function __construct(
        protected DirectBilletDTO $directBilletDTO,
    ) {
    }

    public function getPath(): string
    {
        return 'payments';
    }

    /** @return array<string, array<string, string|null>|float|int|string> */
    public function getData(): array
    {
        return [
            'customer' => $this->directBilletDTO->customerId,
            'billingType' => $this->directBilletDTO->billingType->value,
            'value' => $this->directBilletDTO->value,
            'dueDate' => $this->directBilletDTO->dueDate,
        ];
    }

    /**
     * @param  array<string,string>  $response
     */
    public function getBilletUrl(array $response): string
    {
        return $response['bankSlipUrl'] ?? '';
    }
}
