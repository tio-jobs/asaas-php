<?php

test('find customer by document', function () {
    // Find first customer
    $asaas = asaasPhp()->customer();

    $result = $asaas->list();
    $data = $result['data'][0] ?? [];

    $response = $asaas->findByDocument($data['cpfCnpj']);

    $customer = $response['data'][0] ?? [];

    expect(json_encode($response))
        ->json()
        ->object->toBe('list')
        ->and(json_encode($customer))
        ->json()
        ->object->toBe('customer')
        ->id->toBe($customer['id']);

});
