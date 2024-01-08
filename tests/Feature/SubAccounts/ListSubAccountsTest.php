<?php

use TioJobs\AsaasPhp\DataTransferObjects\SubAccounts\SubAccountWebhooksDTO;

test('list all subaccounts', function () {
    $company = generateCompany();

    // Create new subaccount
    $subAccountDto = new \TioJobs\AsaasPhp\DataTransferObjects\SubAccounts\SubAccountDTO(
        name: $company['name'],
        email: $company['email'],
        document: $company['cpfCnpj'],
        companyType: \TioJobs\AsaasPhp\Enums\CompanyTypeEnum::INDIVIDUAL,
        mobilePhone: $company['mobilePhone'],
        postalCode: $company['postalCode'],
        address: $company['address'],
        addressNumber: $company['addressNumber'],
        province: $company['province'],
        subAccountWebhooksDTO: new SubAccountWebhooksDTO(),
        complement: '',
        site: 'https://www.tester.com.br',
    );
    
    $resourceSubAccount = new \TioJobs\AsaasPhp\Endpoints\SubAccounts\CreateSubAccount(
        apiKey: config('asaas-php.environment.sandbox.key'),
        subAccountDTO: $subAccountDto,
    );
    
    $responseSubAccount = \TioJobs\AsaasPhp\Facades\AsaasPhp::create($resourceSubAccount);

    expect(json_encode($responseSubAccount))
        ->json()
        ->object->toBe('account')
        ->email->toBe($company['email']);

    // List all subaccounts
    $resourceList = new \TioJobs\AsaasPhp\Endpoints\SubAccounts\ListSubAccounts(
        apiKey: config('asaas-php.environment.sandbox.key'),
    );
    
    $responseList = \TioJobs\AsaasPhp\Facades\AsaasPhp::list($resourceList);

    $data = $responseList['data'][0] ?? [];

    expect(json_encode($data))
        ->json()
        ->object->toBe('account');
});