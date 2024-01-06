<?php

test('', function () {
    $resource = new \TioJobs\AsaasPhp\Endpoints\Customers\CreateCustomer(
        apiKey: config('asaas-php.mode.sandbox.key'),
        name: 'Fulano de Tal',
        cpfCnpj: sanitize("376.962.245-65"),
        email: str("fulano@teste.com.br")->lower()->toString(),
        mobilePhone: sanitize("(16) 99222-3333"),
    );

    $response = \TioJobs\AsaasPhp\Facades\AsaasPhp::create($resource);

    expect(json_encode($response))
        ->json()
        ->object->toBe('customer')
        ->name->toBe('Fulano de Tal');
});