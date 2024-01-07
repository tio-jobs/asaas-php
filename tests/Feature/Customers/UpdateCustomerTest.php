<?php

test('update existing customer', function () {
    // Found the first user
    $resourceList = new \TioJobs\AsaasPhp\Endpoints\Customers\ListCustomers(
        apiKey: config('asaas-php.mode.sandbox.key'),
    );

    $responseList = \TioJobs\AsaasPhp\Facades\AsaasPhp::list($resourceList);
    $data = $responseList['data'][0] ?? [];

    // Editing the first user
    $resource = new \TioJobs\AsaasPhp\Endpoints\Customers\UpdateCustomer(
        apiKey: config('asaas-php.mode.sandbox.key'),
        id: $data['id'],
        mobilePhone: sanitize("(16) 99333-3333"),
    );

    $response = \TioJobs\AsaasPhp\Facades\AsaasPhp::update($resource);

    expect(json_encode($response))
        ->json()
        ->object->toBe('customer')
        ->id->toBe($data['id']);
});
