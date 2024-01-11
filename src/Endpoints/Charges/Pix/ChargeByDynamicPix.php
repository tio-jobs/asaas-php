<?php

namespace TioJobs\AsaasPhp\Endpoints\Charges\Pix;

use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;
use TioJobs\AsaasPhp\DataTransferObjects\Charges\Pix\DynamicPixDTO;

class ChargeByDynamicPix implements AsaasInterface
{
    public function __construct(
        protected DynamicPixDTO $dynamicPixDTO,
    ) {
    }

    public function getPath(): string
    {
        return 'payments';
    }

    /** @return array<string, mixed> */
    public function getData(): array
    {
        return [
            'customer' => $this->dynamicPixDTO->customerId,
            'billingType' => $this->dynamicPixDTO->billingType->value,
            'value' => $this->dynamicPixDTO->value,
            'dueDate' => $this->dynamicPixDTO->dueDate,
        ];
    }
}
