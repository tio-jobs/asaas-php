<?php

use Ciareis\Bypass\Route;
use Ciareis\Bypass\Bypass;

test('create new customer', function () {
    $customer = generateCustomer();

    if (FakeApi()) {
        //Load fixtures
        $customer = fixture('data/customers/customer.php');
        $customerEndpointResponse = fixture('responses/customers/create.php');

        //Serve customer endpoint response with Bypass
        $bypass = Bypass::serve(
            Route::post(uri: '/customers', body: $customerEndpointResponse)
        );

        //Set the Sandbox URL to bypass URL
        app('config')->set('asaas-php.environment.sandbox.url', $bypass->getBaseUrl());
    }

    $response = asaasPhp()->customer()->create(...$customer);

    expect($response)
        ->object->toBe('customer')
        ->name->toBe($customer['name'])
        ->and(array_keys($response))->toEqualCanonicalizing(['object','id','dateCreated','name','email','company','phone','mobilePhone','address','addressNumber','complement','province','postalCode','cpfCnpj','personType','deleted','additionalEmails','externalReference','notificationDisabled','observations','municipalInscription','stateInscription','canDelete','cannotBeDeletedReason','canEdit','cannotEditReason','city','state','country','groups']);
});
