<?php

test('check if AsaasPhp facade return the Asaas instance', function () {
    $asaas = \TioJobs\AsaasPhp\Facades\AsaasPhp::getFacadeRoot();

    expect($asaas)->toBeInstanceOf(\TioJobs\AsaasPhp\Core\Asaas::class);
});