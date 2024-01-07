<?php

test('restore a deleted customer', function () {
    // Found the first user
    $resourceList = new \TioJobs\AsaasPhp\Endpoints\Customers\ListCustomers(
        apiKey: config('asaas-php.environment.sandbox.key'),
    );

    $responseList = \TioJobs\AsaasPhp\Facades\AsaasPhp::list($resourceList);
    $data = $responseList['data'][0] ?? [];

    // Delete found customer
    $resource = new \TioJobs\AsaasPhp\Endpoints\Customers\DeleteCustomer(
        apiKey: config('asaas-php.environment.sandbox.key'),
        id: $data['id'],
    );

    $response = \TioJobs\AsaasPhp\Facades\AsaasPhp::delete($resource);

    expect(json_encode($response))
        ->json()
        ->deleted->toBeTrue()
        ->id->toBe($data['id']);

    // Restoring customer
    $resource = new \TioJobs\AsaasPhp\Endpoints\Customers\RestoreCustomer(
        apiKey: config('asaas-php.environment.sandbox.key'),
        id: $response['id'],
    );

    $restoredResponse = \TioJobs\AsaasPhp\Facades\AsaasPhp::restore($resource);

    expect(json_encode($restoredResponse))
        ->json()
        ->object->toBe('customer')
        ->deleted->toBeFalse();
});