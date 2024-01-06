<?php

namespace TioJobs\AsaasPhp\DataTransferObjects\Charges\Pix;

use TioJobs\AsaasPhp\Enums\BillingTypeEnum;

class DynamicPixDTO
{
    public function __construct(
        public readonly string $customerId,
        public readonly float $value,
        public readonly BillingTypeEnum $billingType = BillingTypeEnum::PIX,
        public string $dueDate = '',
    ) {
        if (blank($this->dueDate)) {
            $this->dueDate = \Carbon\Carbon::now()->addMinutes(60)->format('Y-m-d');
        }
    }
}
