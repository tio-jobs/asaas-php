<?php

namespace TioJobs\AsaasPhp\Endpoints\Customers;

use TioJobs\AsaasPhp\Concerns\HasId;
use TioJobs\AsaasPhp\Concerns\HasIdAndData;
use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasNullableToken;
use TioJobs\AsaasPhp\Concerns\HasToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class UpdateCustomer implements AsaasInterface
{
    use HasMode;
    use HasToken;

    public function __construct(
        public readonly string $apiKey,
        public readonly string $id,
        public readonly ?string $name = null,
        public readonly ?string $cpfCnpj = null,
        public readonly ?string $email = null,
        public readonly ?string $phone = null,
        public readonly ?string $mobilePhone = null,
        public readonly ?string $address = null,
        public readonly ?string $addressNumber = null,
        public readonly ?string $complement = null,
        public readonly ?string $province = null,
        public readonly ?string $postalCode = null,
        public readonly ?string $externalReference = null,
        public readonly ?bool $notificationDisabled = null,
        public readonly ?string $additionalEmails = null,
        public readonly ?string $municipalInscription = null,
        public readonly ?string $stateInscription = null,
        public readonly ?string $observations = null,
        public readonly ?string $groupName = null,
        public readonly ?string $company = null,
    ) {
    }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.mode.{$this->getMode()}.url");
        assert(is_string($endpoint));

        return "{$endpoint}/customers/{$this->id}";
    }

    /**
     * @throws \JsonException
     * @return array<string,mixed>
     */
    public function getData(): array
    {
        $data = json_decode(json_encode($this, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
        assert(is_array($data));
        unset($data['apiKey'], $data['id']);

        return array_filter($data, fn ($value) => !is_null($value));
    }
}
