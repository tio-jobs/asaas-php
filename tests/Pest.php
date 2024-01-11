<?php

use TioJobs\AsaasPhp\Core\Asaas;

uses(\TioJobs\AsaasPhp\Tests\TestCase::class)->in(__DIR__);

function generateCustomer(): array
{
    $faker = \Faker\Factory::create('pt_BR');

    return [
        'name' => $faker->name,
        'cpfCnpj' => $faker->cpf,
        'email' => $faker->safeEmail,
        'phone' => '16'.$faker->landline,
        'mobilePhone' => '16'.$faker->cellphone,
        'address' => explode(',', $faker->address)[1],
        'addressNumber' => $faker->randomNumber(4),
        'complement' => '',
        'province' => $faker->city,
        'postalCode' => $faker->postcode,
        'externalReference' => '',
        'notificationDisabled' => false,
        'additionalEmails' => '',
        'municipalInscription' => '',
        'stateInscription' => '',
        'observations' => 'Generated by faker test',
        'groupName' => 'Tests',
        'company' => $faker->company,
    ];
}

function asaasPhp(?string $apiKey = null, string $mode = 'sandbox'): Asaas
{
    return new Asaas($apiKey ?? config('asaas-php.environment.sandbox.key'), $mode);
}

function generateCompany(): array
{
    $faker = \Faker\Factory::create('pt_BR');

    return [
        'name' => $faker->name,
        'cpfCnpj' => $faker->cnpj,
        'email' => $faker->safeEmail,
        'phone' => '16'.$faker->landline,
        'mobilePhone' => '16'.$faker->cellphone,
        'address' => 'Rua Visconde do Rio Branco',
        'addressNumber' => $faker->randomNumber(4),
        'complement' => '',
        'province' => 'Ribeirão Preto',
        'postalCode' => '14015-000',
        'externalReference' => '',
        'notificationDisabled' => false,
        'additionalEmails' => '',
        'municipalInscription' => '',
        'stateInscription' => '',
        'observations' => 'Generated by faker test',
        'groupName' => 'Tests',
        'company' => $faker->company,
    ];
}
