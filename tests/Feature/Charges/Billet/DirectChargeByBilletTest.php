<?php

test('check if customer can charge by billet', function () {
    // Create a new customer
    $customer = generateCustomer();

    $resourceCustomer = new \TioJobs\AsaasPhp\Endpoints\Customers\CreateCustomer(
        config('asaas-php.environment.sandbox.key'),
        ...$customer,
    );

    $responseCustomer = \TioJobs\AsaasPhp\Facades\AsaasPhp::create($resourceCustomer);

    // Create new charge by Billet
    $data = new \TioJobs\AsaasPhp\DataTransferObjects\Charges\Billet\DirectBilletDTO(
        customerId: $responseCustomer['id'],
        value: 19.99,
    );

    $resource = new \TioJobs\AsaasPhp\Endpoints\Charges\Billet\DirectChargeByBillet(
        apiKey: config('asaas-php.environment.sandbox.key'),
        directBilletDTO: $data,
    );

    $response = \TioJobs\AsaasPhp\Facades\AsaasPhp::charge($resource);

    expect(json_encode($response))
        ->json()
        ->object->toBe('payment')
        ->customer->toBe($responseCustomer['id']);

    expect($resource->getBilletUrl($response))
        ->toBeString()
        ->toBeUrl();
});