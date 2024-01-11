<?php

namespace TioJobs\AsaasPhp\DataTransferObjects\SubAccounts;

use TioJobs\AsaasPhp\Enums\CompanyTypeEnum;

class SubAccountDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public string $document,
        public readonly CompanyTypeEnum $companyType,
        public string $mobilePhone,
        public readonly string $postalCode,
        public readonly string $address,
        public readonly string $addressNumber,
        public readonly string $province,
        public readonly SubAccountWebhooksDTO $subAccountWebhooksDTO,
        public ?string $birthDate = null,
        public readonly string $complement = '',
        public readonly string $site = '',
    ) {
        $this->document = sanitize($this->document);
        $this->mobilePhone = sanitize($this->mobilePhone);
    }
}
