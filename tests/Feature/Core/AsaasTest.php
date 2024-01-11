<?php
use Illuminate\Support\Facades\Config;
use TioJobs\AsaasPhp\Exceptions\ExceptionRequiredApiKey;
use TioJobs\AsaasPhp\Facades\AsaasPhp;

it('api key is required when allowing sub-accounts', function(){

    Config::set('asaas-php.allow_sub_accounts', true);

    AsaasPhp::withKey('')->customer()->get(id: '123');

})->throws(ExceptionRequiredApiKey::class, 'You must provide an API key. You can do so by passing it as a parameter to the constructor or methods (e.g., make(apiKey) or withKey(apiKey)).');

todo('check list method');
todo('check create method');
todo('check get method');
todo('check find method');
todo('check update method');
todo('check delete method');
todo('check restore method');
todo('check notifications method');
todo('check charge method');
todo('check upload method');
