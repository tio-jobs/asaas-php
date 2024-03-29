<?php

namespace TioJobs\AsaasPhp\Endpoints\Charges\CreditCard;

use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;
use TioJobs\AsaasPhp\DataTransferObjects\Charges\CreditCard\DirectCreditCardDTO;

class DirectChargeByCreditCard implements AsaasInterface
{
    public function __construct(
        protected DirectCreditCardDTO $directCreditCardDTO,
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
            'customer' => $this->directCreditCardDTO->customerId,
            'billingType' => $this->directCreditCardDTO->billingType->value,
            'value' => $this->directCreditCardDTO->value,
            'dueDate' => $this->directCreditCardDTO->dueDate,
            'creditCard' => [
                'holderName' => $this->directCreditCardDTO->creditCardDTO->holderName,
                'number' => sanitize($this->directCreditCardDTO->creditCardDTO->number),
                'expiryMonth' => $this->directCreditCardDTO->creditCardDTO->expiryMonth,
                'expiryYear' => $this->directCreditCardDTO->creditCardDTO->expiryYear,
                'ccv' => $this->directCreditCardDTO->creditCardDTO->ccv,
            ],
            'creditCardHolderInfo' => [
                'name' => $this->directCreditCardDTO->creditCardHolderInfoDTO->name,
                'email' => $this->directCreditCardDTO->creditCardHolderInfoDTO->email,
                'cpfCnpj' => sanitize($this->directCreditCardDTO->creditCardHolderInfoDTO->document),
                'postalCode' => $this->directCreditCardDTO->creditCardHolderInfoDTO->postalCode,
                'addressNumber' => $this->directCreditCardDTO->creditCardHolderInfoDTO->addressNumber,
                'addressComplement' => $this->directCreditCardDTO->creditCardHolderInfoDTO->addressComplement,
                'phone' => sanitize($this->directCreditCardDTO->creditCardHolderInfoDTO->phone),
                'mobilePhone' => sanitize($this->directCreditCardDTO->creditCardHolderInfoDTO->mobilePhone),
            ],
            'remoteIP' => $this->directCreditCardDTO->removeIP,
        ];
    }
}
