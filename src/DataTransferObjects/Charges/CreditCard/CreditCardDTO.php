<?php

namespace TioJobs\AsaasPhp\DataTransferObjects\Charges\CreditCard;

class CreditCardDTO
{
    public function __construct(
        public readonly string $holderName,
        public readonly string $number,
        public readonly string $expiryMonth,
        public readonly string $expiryYear,
        public readonly string $ccv,
    ) { }
}
