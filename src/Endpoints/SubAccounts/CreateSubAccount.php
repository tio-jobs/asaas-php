<?php

namespace TioJobs\AsaasPhp\Endpoints\SubAccounts;

use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;
use TioJobs\AsaasPhp\DataTransferObjects\SubAccounts\SubAccountDTO;

class CreateSubAccount implements AsaasInterface
{
    public function __construct(
        protected SubAccountDTO $subAccountDTO,
    ) {
    }

    public function getPath(): string
    {
        return 'accounts';
    }

    /**
     * @return array<string, array<int, array<string, mixed>>|string>
     */
    public function getData(): array
    {
        return [
            'name' => $this->subAccountDTO->name,
            'email' => $this->subAccountDTO->email,
            'cpfCnpj' => $this->subAccountDTO->document,
            'companyType' => $this->subAccountDTO->companyType->value,
            'mobilePhone' => $this->subAccountDTO->mobilePhone,
            'site' => $this->subAccountDTO->site,
            'postalCode' => $this->subAccountDTO->postalCode,
            'address' => $this->subAccountDTO->address,
            'addressNumber' => $this->subAccountDTO->addressNumber,
            'complement' => $this->subAccountDTO->complement,
            'province' => $this->subAccountDTO->province,
            'webhooks' => [
                0 => [
                    'url' => $this->subAccountDTO->subAccountWebhooksDTO->url,
                    'email' => $this->subAccountDTO->subAccountWebhooksDTO->email,
                    'apiVersion' => $this->subAccountDTO->subAccountWebhooksDTO->apiVersion,
                    'enabled' => $this->subAccountDTO->subAccountWebhooksDTO->enabled,
                    'interrupted' => $this->subAccountDTO->subAccountWebhooksDTO->interrupted,
                    'authToken' => $this->subAccountDTO->subAccountWebhooksDTO->authToken,
                ],
            ],
        ];
    }
}
