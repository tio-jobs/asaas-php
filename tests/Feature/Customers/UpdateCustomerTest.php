<?php

test('update existing customer', function () {

    // Found the first user
    $asaas = asaasPhp()->customer();

    $responseList = $asaas->list();
    $data = $responseList['data'][0] ?? [];

    $response = $asaas->update(id: $data['id'], name: $data['name'], mobilePhone: sanitize('(16) 99333-3333'));

    expect(json_encode($response))
        ->json()
        ->object->toBe('customer')
        ->id->toBe($data['id']);
})->onlyWithSandboxApi();
