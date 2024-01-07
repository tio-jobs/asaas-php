<?php

test('check customer notifications', function () {
    // Found the first user
    $resourceList = new \TioJobs\AsaasPhp\Endpoints\Customers\ListCustomers(
        apiKey: config('asaas-php.environment.sandbox.key'),
    );

    $responseList = \TioJobs\AsaasPhp\Facades\AsaasPhp::list($resourceList);
    $data = $responseList['data'][0] ?? [];

    // Get customer notifications
    $resource = new \TioJobs\AsaasPhp\Endpoints\Customers\CustomerNotification(
        apiKey: config('asaas-php.environment.sandbox.key'),
        id: $data['id'],
    );

    $response = \TioJobs\AsaasPhp\Facades\AsaasPhp::notifications($resource);
    $notification = $response['data'][0] ?? [];

    expect(json_encode($response))
        ->json()
        ->object->toBe('list');

    expect(json_encode($notification))
        ->json()
        ->object->toBe('notification')
        ->customer->toBe($data['id']);
});