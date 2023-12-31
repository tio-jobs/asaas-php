<?php

namespace TioJobs\AsaasPhp\Endpoints\SubAccounts;

use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;
use TioJobs\AsaasPhp\DataTransferObjects\SubAccounts\SubAccountDTO;

class CreateSubAccount implements AsaasInterface
{
    use HasToken;
    use HasMode;

    public function __construct(
        public readonly string $apiKey,
        protected SubAccountDTO $subAccountDTO,
    ) {
    }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.environment.{$this->getMode()}.url");
        assert(is_string($endpoint));

        return "{$endpoint}/accounts";
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
