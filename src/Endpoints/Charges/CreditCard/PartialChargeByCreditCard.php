<?php

namespace TioJobs\AsaasPhp\Endpoints\Charges\CreditCard;

use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasNullableToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasChargeInterface;
use TioJobs\AsaasPhp\DataTransferObjects\Charges\CreditCard\DirectCreditCardDTO;
use TioJobs\AsaasPhp\DataTransferObjects\Charges\CreditCard\PartialCreditCardDTO;

class PartialChargeByCreditCard implements AsaasChargeInterface
{
    use HasMode;
    use HasNullableToken;

    public function __construct(
        protected PartialCreditCardDTO $partialCreditCardDTO,
    ) {
    }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.mode.{$this->getMode()}.url");

        return "{$endpoint}/payments";
    }

    public function getData(): array
    {
        return [
            "customer" =>  $this->partialCreditCardDTO->customerId,
            "billingType" =>  $this->partialCreditCardDTO->billingType->value,
            "value" =>  $this->partialCreditCardDTO->value,
            "dueDate" =>  $this->partialCreditCardDTO->dueDate,
            "installmentCount" => $this->partialCreditCardDTO->installments,
            "installmentValue" => $this->partialCreditCardDTO->installmentValue,
            "creditCard" =>  [
                "holderName" =>  $this->partialCreditCardDTO->creditCardDTO->holderName,
                "number" =>  sanitize($this->partialCreditCardDTO->creditCardDTO->number),
                "expiryMonth" =>  $this->partialCreditCardDTO->creditCardDTO->expiryMonth,
                "expiryYear" =>  $this->partialCreditCardDTO->creditCardDTO->expiryYear,
                "ccv" =>  $this->partialCreditCardDTO->creditCardDTO->ccv,
            ],
            "creditCardHolderInfo" =>  [
                "name" =>  $this->partialCreditCardDTO->creditCardHolderInfoDTO->name,
                "email" =>  $this->partialCreditCardDTO->creditCardHolderInfoDTO->email,
                "cpfCnpj" =>  sanitize($this->partialCreditCardDTO->creditCardHolderInfoDTO->document),
                "postalCode" =>  $this->partialCreditCardDTO->creditCardHolderInfoDTO->postalCode,
                "addressNumber" =>  $this->partialCreditCardDTO->creditCardHolderInfoDTO->addressNumber,
                "addressComplement" =>  $this->partialCreditCardDTO->creditCardHolderInfoDTO->addressComplement,
                "phone" =>  sanitize($this->partialCreditCardDTO->creditCardHolderInfoDTO->phone),
                "mobilePhone" =>  sanitize($this->partialCreditCardDTO->creditCardHolderInfoDTO->mobilePhone),
            ],
            "remoteIP" =>  $this->partialCreditCardDTO->removeIP,
        ];
    }
}
