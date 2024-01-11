<?php

test('create new customer', function () {
    $customer = generateCustomer();

    $response = asaasPhp()->customer()->create(...$customer);

    expect(json_encode($response))
        ->json()
        ->object->toBe('customer')
        ->name->toBe($customer['name']);
});
