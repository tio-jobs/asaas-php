<?php

test('create new customer', function () {
    $customer = generateCustomer();

    $resource = new \TioJobs\AsaasPhp\Endpoints\Customers\CreateCustomer(
        config('asaas-php.mode.sandbox.key'),
        ...$customer,
    );

    $response = \TioJobs\AsaasPhp\Facades\AsaasPhp::create($resource);

    expect(json_encode($response))
        ->json()
        ->object->toBe('customer')
        ->name->toBe($customer['name']);
});