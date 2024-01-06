<?php

namespace TioJobs\AsaasPhp\DataTransferObjects\Charges\CreditCard;

class CreditCardHolderInfoDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $document,
        public readonly string $postalCode,
        public readonly string $addressNumber,
        public readonly string $phone,
        public readonly string $mobilePhone,
        public readonly ?string $addressComplement = null,
    ) { }
}
