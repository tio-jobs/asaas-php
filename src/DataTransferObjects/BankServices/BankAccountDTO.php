<?php

namespace TioJobs\AsaasPhp\DataTransferObjects\BankServices;

use TioJobs\AsaasPhp\Enums\BankAccountTypeEnum;

class BankAccountDTO
{
    public function __construct(
        public readonly string $bankCode,
        public readonly string $accountName,
        public readonly string $ownerName,
        public string $document,
        public readonly string $agency,
        public readonly string $accountNumber,
        public readonly string $accountDigit,
        public readonly BankAccountTypeEnum $bankAccountTypeEnum,
    ) {
        $this->document = sanitize($this->document);
    }
}
