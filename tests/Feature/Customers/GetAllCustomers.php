<?php

test('get all customers', function () {
    $resource = new \TioJobs\AsaasPhp\Endpoints\Customers\ListCustomers(
        apiToken: config('asaas-php.mode.sandbox.key'),
    );

    $response = \TioJobs\AsaasPhp\Facades\AsaasPhp::list($resource);
    $data = $response['data'][0] ?? [];

    expect(json_encode($data))
        ->json()
        ->object->toBe('customer');
});