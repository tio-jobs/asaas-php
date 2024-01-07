<?php

test('get specific customer by ID', function () {
    // Find a first customer
    $resource = new \TioJobs\AsaasPhp\Endpoints\Customers\ListCustomers(
        apiKey: config('asaas-php.mode.sandbox.key'),
    );

    $response = \TioJobs\AsaasPhp\Facades\AsaasPhp::list($resource);
    $data = $response['data'][0] ?? [];

    // Get customer by ID
    $resource = new \TioJobs\AsaasPhp\Endpoints\Customers\GetCustomer(
        apiKey: config('asaas-php.mode.sandbox.key'),
        id: $data['id'],
    );

    $response = \TioJobs\AsaasPhp\Facades\AsaasPhp::get($resource);

    expect(json_encode($response))
        ->json()
        ->object->toBe('customer')
        ->id->toBe($data['id']);
});