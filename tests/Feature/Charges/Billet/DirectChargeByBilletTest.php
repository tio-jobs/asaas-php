<?php

use TioJobs\AsaasPhp\DataTransferObjects\Charges\Billet\DirectBilletDTO;

test('check if customer can charge by billet', function () {
    // Create a new customer
    $customer = generateCustomer();

    $asaas = asaasPhp();

    $responseCustomer = $asaas->customer()->create(...$customer);

    // Create new charge by Billet
    $data = new DirectBilletDTO(
        customerId: $responseCustomer['id'],
        value: 19.99,
    );

    $charge = $asaas->charge();

    $response = $charge->directByBillet($data);

    expect(json_encode($response))
        ->json()
        ->object->toBe('payment')
        ->customer->toBe($responseCustomer['id'])
        ->and($charge->getBilletUrl($response))
        ->toBeString()
        ->toBeUrl();

})->onlyWithSandboxApi();
