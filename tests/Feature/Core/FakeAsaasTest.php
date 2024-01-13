<?php

use TioJobs\AsaasPhp\Facades\AsaasPhp;
use Illuminate\Http\Client\Request;


it('can find the customer by id by mocking the response', function(){

    AsaasPhp::fake(fn() => fakeResponse(['id' => '123']));

    $customer = AsaasPhp::withKey('api-key')->customer()->get(id: '123');

    AsaasPhp::assertSent(function (Request $request) {
        return $request->hasHeader('access_token', 'api-key');
    });

    expect($customer)
        ->toBeArray()
        ->toHaveKey('id', '123');

});