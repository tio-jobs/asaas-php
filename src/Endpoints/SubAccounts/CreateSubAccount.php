<?php

namespace TioJobs\AsaasPhp\Endpoints\SubAccounts;

use TioJobs\AsaasPhp\Concerns\HasData;
use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasNullableToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;
use TioJobs\AsaasPhp\DataTransferObjects\SubAccounts\SubAccountDTO;
use TioJobs\AsaasPhp\Enums\CompanyTypeEnum;

class CreateSubAccount implements AsaasInterface
{
    use HasMode;
    use HasNullableToken;

    public function __construct(
        protected SubAccountDTO $subAccountDTO,
    ) {
    }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.mode.{$this->getMode()}.url");
        assert(is_string($endpoint));

        return "{$endpoint}/accounts";
    }


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
