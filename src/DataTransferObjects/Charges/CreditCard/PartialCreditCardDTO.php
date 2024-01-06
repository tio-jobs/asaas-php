<?php

namespace TioJobs\AsaasPhp\DataTransferObjects\Charges\CreditCard;

use TioJobs\AsaasPhp\Enums\BillingTypeEnum;

class PartialCreditCardDTO
{
    public function __construct(
        public readonly string $customerId,
        public readonly float $value,
        public readonly int $installments,
        public readonly float $installmentValue,
        public readonly CreditCardDTO $creditCardDTO,
        public readonly CreditCardHolderInfoDTO $creditCardHolderInfoDTO,
        public readonly BillingTypeEnum $billingType = BillingTypeEnum::CREDIT_CARD,
        public string $dueDate = '',
        public string $removeIP = '',
    ) {
        if (blank($this->dueDate)) {
            $this->dueDate = \Carbon\Carbon::now()->addDays(3)->format('Y-m-d');
        }

        if (blank($this->removeIP)) {
            $this->removeIP = get_remote_ip();
        }
    }
}
