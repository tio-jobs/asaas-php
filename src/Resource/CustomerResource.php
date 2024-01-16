<?php

namespace TioJobs\AsaasPhp\Resource;

use TioJobs\AsaasPhp\Endpoints\Customers\CreateCustomer;
use TioJobs\AsaasPhp\Endpoints\Customers\CustomerNotification;
use TioJobs\AsaasPhp\Endpoints\Customers\DeleteCustomer;
use TioJobs\AsaasPhp\Endpoints\Customers\FindCustomerByDocument;
use TioJobs\AsaasPhp\Endpoints\Customers\GetCustomer;
use TioJobs\AsaasPhp\Endpoints\Customers\ListCustomers;
use TioJobs\AsaasPhp\Endpoints\Customers\RestoreCustomer;
use TioJobs\AsaasPhp\Endpoints\Customers\UpdateCustomer;

class CustomerResource extends Resource
{
    /**
     * @return array<string, mixed>
     */
    public function create(?string $name = null, ?string $cpfCnpj = null, ?string $email = null, ?string $phone = null, ?string $mobilePhone = null, ?string $address = null, ?string $addressNumber = null, ?string $complement = null, ?string $province = null, ?string $postalCode = null, ?string $externalReference = null, ?bool $notificationDisabled = null, ?string $additionalEmails = null, ?string $municipalInscription = null, ?string $stateInscription = null, ?string $observations = null, ?string $groupName = null, ?string $company = null): array
    {
        return $this->asaas->post(new CreateCustomer($name, $cpfCnpj, $email, $phone, $mobilePhone, $address, $addressNumber, $complement, $province, $postalCode, $externalReference, $notificationDisabled, $additionalEmails, $municipalInscription, $stateInscription, $observations, $groupName, $company));
    }

    /**
     * @return array<string, mixed>
     */
    public function update(string $id, ?string $name = null, ?string $cpfCnpj = null, ?string $email = null, ?string $phone = null, ?string $mobilePhone = null, ?string $address = null, ?string $addressNumber = null, ?string $complement = null, ?string $province = null, ?string $postalCode = null, ?string $externalReference = null, ?bool $notificationDisabled = null, ?string $additionalEmails = null, ?string $municipalInscription = null, ?string $stateInscription = null, ?string $observations = null, ?string $groupName = null, ?string $company = null): array
    {
        return $this->asaas->put(new UpdateCustomer($id, $name, $cpfCnpj, $email, $phone, $mobilePhone, $address, $addressNumber, $complement, $province, $postalCode, $externalReference, $notificationDisabled, $additionalEmails, $municipalInscription, $stateInscription, $observations, $groupName, $company));
    }

    /**
     * @return array<string, mixed>
     */
    public function delete(string $id): array
    {
        return $this->asaas->delete(new DeleteCustomer($id));
    }

    /**
     * @return array<string, mixed>
     */
    public function get(string $id): array
    {
        return $this->asaas->get(new GetCustomer($id));
    }

    /**
     * @return array<string, mixed>
     */
    public function list(): array
    {
        return $this->asaas->get(new ListCustomers());
    }

    /**
     * @return array<string, mixed>
     */
    public function findByDocument(string $document): array
    {
        return $this->asaas->get(new FindCustomerByDocument($document));
    }

    /**
     * @return array<string, mixed>
     */
    public function restore(string $id): array
    {
        return $this->asaas->get(new RestoreCustomer($id));
    }

    /**
     * @return array<string, mixed>
     */
    public function notifications(string $id): array
    {
        return $this->asaas->get(new CustomerNotification($id));
    }
}
