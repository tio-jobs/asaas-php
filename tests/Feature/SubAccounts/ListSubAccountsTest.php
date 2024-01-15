<?php

use TioJobs\AsaasPhp\DataTransferObjects\SubAccounts\SubAccountDTO;
use TioJobs\AsaasPhp\DataTransferObjects\SubAccounts\SubAccountWebhooksDTO;
use TioJobs\AsaasPhp\Enums\CompanyTypeEnum;

// Limit of 20 accounts per day per key

test('list all subaccounts', function () {
    $company = generateCompany();

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

    $asaasSubAccount = asaasPhp()->subAccount();
    $newSubAccount = $asaasSubAccount->create($subAccountDto);

    //Create a sub-account
    expect($newSubAccount)
        ->object->toBe('account')
        ->email->toBe($company['email'])
        ->and(array_keys($newSubAccount))->toEqualCanonicalizing(['object','id','name','email','loginEmail','phone','mobilePhone','address','addressNumber','complement','province','postalCode','cpfCnpj','birthDate','personType','companyType','city','state','country','tradingName','site','walletId','apiKey','accountNumber']);

    //Retrieve all sub-accounts
    $allSubAccounts = $asaasSubAccount->all();

    expect($allSubAccounts)
        ->data->{0}->object->toBe('account')
        ->and(array_keys($allSubAccounts))->toEqualCanonicalizing(['object','hasMore','totalCount','limit','offset','data']);

})->onlyWithSandboxApi();
