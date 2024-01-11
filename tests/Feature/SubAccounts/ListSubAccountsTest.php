<?php

use TioJobs\AsaasPhp\DataTransferObjects\SubAccounts\SubAccountDTO;
use TioJobs\AsaasPhp\DataTransferObjects\SubAccounts\SubAccountWebhooksDTO;
use TioJobs\AsaasPhp\Enums\CompanyTypeEnum;

test('list all subaccounts', function () {
    $company = generateCompany();

    $asaas = asaasPhp();

    // Create new subaccount
    $subAccountDto = new SubAccountDTO(
        name: $company['name'],
        email: $company['email'],
        document: $company['cpfCnpj'],
        companyType: CompanyTypeEnum::INDIVIDUAL,
        mobilePhone: $company['mobilePhone'],
        postalCode: $company['postalCode'],
        address: $company['address'],
        addressNumber: $company['addressNumber'],
        province: $company['province'],
        subAccountWebhooksDTO: new SubAccountWebhooksDTO(),
        complement: '',
        site: 'https://www.tester.com.br',
    );

    $responseSubAccount = $asaas->subAccount()->create($subAccountDto);

    expect(json_encode($responseSubAccount))
        ->json()
        ->object->toBe('account')
        ->email->toBe($company['email']);

    $responseList = $asaas->subAccount()->all();

    expect(json_encode($responseList['data'][0] ?? []))
        ->json()
        ->object->toBe('account');
});
