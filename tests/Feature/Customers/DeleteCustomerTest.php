<?php

test('delete existing customer', function () {
    // Found the first user
    $resourceList = new \TioJobs\AsaasPhp\Endpoints\Customers\ListCustomers(
        apiKey: config('asaas-php.mode.sandbox.key'),
    );

    $responseList = \TioJobs\AsaasPhp\Facades\AsaasPhp::list($resourceList);
    $data = $responseList['data'][0] ?? [];

    // Delete found customer
    $resource = new \TioJobs\AsaasPhp\Endpoints\Customers\DeleteCustomer(
        apiKey: config('asaas-php.mode.sandbox.key'),
        id: $data['id'],
    );

    $response = \TioJobs\AsaasPhp\Facades\AsaasPhp::delete($resource);

    expect(json_encode($response))
        ->json()
        ->deleted->toBeTrue()
        ->id->toBe($data['id']);
});