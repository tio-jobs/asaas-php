<?php

$version = env('ASAAS_API_VERSION', 'v3');
$sandboxBaseUrl = env('ASAAS_SANDBOX_BASE_URL', 'https://sandbox.asaas.com/api/');
$productionBaseUrl = env('ASAAS_PRODUCTION_BASE_URL', 'https://api.asaas.com/');

return [
    'allow_sub_accounts' => env('ASAAS_ALLOW_SUB_ACCOUNTS', false),
    'version' => $version,
    'environment' => [
        'sandbox' => [
            'url' => "{$sandboxBaseUrl}{$version}",
            'key' => env('ASAAS_SANDBOX_API_KEY'),
            'pix_key' => env('ASAAS_SANDBOX_PIX_KEY'),
            'email' => env('ASAAS_SANDBOX_EMAIL_ACCOUNT'),
            'webhook_url' => env('ASAAS_SANDBOX_WEBHOOK_URL'),
            'webhook_token' => env('ASAAS_SANDBOX_WEBHOOK_TOKEN'),
        ],
        'production' => [
            'url' => "{$productionBaseUrl}{$version}",
            'key' => env('ASAAS_PRODUCTION_API_KEY'),
            'pix_key' => env('ASAAS_PRODUCTION_PIX_KEY'),
            'email' => env('ASAAS_PRODUCTION_EMAIL_ACCOUNT'),
            'webhook_url' => env('ASAAS_PRODUCTION_WEBHOOK_URL'),
            'webhook_token' => env('ASAAS_PRODUCTION_WEBHOOK_TOKEN'),
        ],
    ],
];
