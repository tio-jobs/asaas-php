<?php

$version = env('ASAAS_API_VERSION', 'v3');

return [
    'version' => $version,
    'mode' => [
        'sandbox' => [
            'url' => "https://sandbox.asaas.com/api/{$version}",
            'key' => env('ASAAS_SANDBOX_API_KEY'),
            'pix_key' => env('ASAAS_SANDBOX_PIX_KEY'),
            'email' => env('ASAAS_SANDBOX_EMAIL_ACCOUNT'),
            'webhook_url' => env('ASAAS_SANDBOX_WEBHOOK_URL'),
            'webhook_token' => env('ASAAS_SANDBOX_WEBHOOK_TOKEN'),
        ],
        'production' => [
            'url' => "https://api.asaas.com/{$version}",
            'key' => env('ASAAS_PRODUCTION_API_KEY'),
            'pix_key' => env('ASAAS_PRODUCTION_PIX_KEY'),
            'email' => env('ASAAS_PRODUCTION_EMAIL_ACCOUNT'),
            'webhook_url' => env('ASAAS_PRODUCTION_WEBHOOK_URL'),
            'webhook_token' => env('ASAAS_PRODUCTION_WEBHOOK_TOKEN'),
        ],
    ],
];
