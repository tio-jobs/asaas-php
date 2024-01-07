<?php

test('find customer by document', function () {
    // Find first customer
    $resourceList = new \TioJobs\AsaasPhp\Endpoints\Customers\ListCustomers(
        apiKey: config('asaas-php.mode.sandbox.key'),
    );

    $result = \TioJobs\AsaasPhp\Facades\AsaasPhp::list($resourceList);
    $data = $result['data'][0] ?? [];

    // Get customer by document
    $resource = new \TioJobs\AsaasPhp\Endpoints\Customers\FindCustomerByDocument(
        apiKey: config('asaas-php.mode.sandbox.key'),
        document: $data['cpfCnpj'],
    );

    $response = \TioJobs\AsaasPhp\Facades\AsaasPhp::find($resource);
    $customer = $response['data'][0] ?? [];

    expect(json_encode($response))
        ->json()
        ->object->toBe('list');

    expect(json_encode($customer))
        ->json()
        ->object->toBe('customer')
        ->id->toBe($customer['id']);
});