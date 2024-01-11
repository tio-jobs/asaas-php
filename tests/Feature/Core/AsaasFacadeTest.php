<?php

use TioJobs\AsaasPhp\Core\Asaas;
use TioJobs\AsaasPhp\Facades\AsaasPhp;

test('check if AsaasPhp facade return the Asaas instance', function () {
    $asaas = AsaasPhp::getFacadeRoot();

    expect($asaas)->toBeInstanceOf(Asaas::class);
});
