<?php

test('get specific customer by ID', function () {
    // Find a first customer
    $asaas = asaasPhp()->customer();

    $response = $asaas->list();
    $data = $response['data'][0] ?? [];

    $response = $asaas->get( $data['id']);

    expect(json_encode($response))
        ->json()
        ->object->toBe('customer')
        ->id->toBe($data['id']);
});
