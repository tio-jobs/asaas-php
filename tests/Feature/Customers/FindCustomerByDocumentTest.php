<?php

test('find customer by document', function () {

    $asaas = asaasPhp()->customer();

    $asaas->create(...generateCustomer());

    $customerList = $asaas->list();

    expect($customerList)
        ->object->toBe('list')
        ->data->not->toBeEmpty()
        ->and(array_keys($customerList))->toEqualCanonicalizing(['object','hasMore','totalCount','limit','offset','data']);

    $firstCustomer = $asaas->findByDocument($customerList['data']['0']['cpfCnpj']);

    expect($firstCustomer['data'][0])
        ->object->toBe('customer')
        ->id->toBe($customerList['data']['0']['id']);

})->onlyWithSandboxApi();
