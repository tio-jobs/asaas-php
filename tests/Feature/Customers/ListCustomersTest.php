<?php

test('get all customers', function () {

    $response = asaasPhp()->customer()->list();

    expect(json_encode($response['data'][0] ?? []))
        ->json()
        ->object->toBe('customer');
});
