<?php

namespace TioJobs\AsaasPhp\DataTransferObjects\Charges\Billet;

use TioJobs\AsaasPhp\Enums\BillingTypeEnum;

class DirectBilletDTO
{
    public function __construct(
        public readonly string $customerId,
        public readonly float $value,
        public readonly BillingTypeEnum $billingType = BillingTypeEnum::BILLET,
        public string $dueDate = '',
    ) {
        if (blank($this->dueDate)) {
            $this->dueDate = \Carbon\Carbon::now()->addDays(3)->format('Y-m-d');
        }
    }
}
