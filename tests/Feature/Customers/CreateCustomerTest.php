<?php

use TioJobs\AsaasPhp\Facades\AsaasPhp;

test('create new customer', function () {
    $customer = generateCustomer();

    $response = AsaasPhp::withKey(config('asaas-php.environment.sandbox.key'), 'sandbox')->customer()->create(...$customer);

    expect(json_encode($response))
        ->json()
        ->object->toBe('customer')
        ->name->toBe($customer['name']);
});
