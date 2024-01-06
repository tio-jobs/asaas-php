# ASAAS PHP
This `Laravel Package` was created abstracting `ASAAS Payment Gateway` endpoints.

---
### SYSTEM REQUIREMENTS
- PHP 8.2+
- Composer 2+
- Laravel 10+

---
### GETTING ASAAS API KEY
To get the ASAAS API KEY you need to access your Profile > Integrations.

---
### INSTALLING PACKAGE
```bash
composer require tio-jobs/asaas-php
```

---
### PUBLISHING CONFIG FILE
To publish the config file just type:
```bash
php artisan vendor:publish

# then search by AsaasPhpServiceProvider and hit [ENTER]
```

---
### CHANGING THE .ENV FILE
Add the API KEY constant in your .env file (with single quotes):
```bash
ASAAS_API_VERION=v3
ASAAS_SANDBOX_API_KEY='your-sandbox-key'
ASAAS_SANDBOX_PIX_KEY=your-sandbox-pix-key
ASAAS_SANDBOX_EMAIL_ACCOUNT='your-sandbox-email'
ASAAS_SANDBOX_WEBHOOK_URL='your-sandbox-webhook-url'
ASAAS_SANDBOX_WEBHOOK_TOKEN='your-random-sandbox-webhook-token'
ASAAS_PRODUCTION_API_KEY='your-production-key'
ASAAS_PRODUCTION_PIX_KEY=your-production-pix-key
ASAAS_PRODUCTION_EMAIL_ACCOUNT='your-production-email'
ASAAS_PRODUCTION_WEBHOOK_URL='your-production-webhook-url'
ASAAS_PRODUCTION_WEBHOOK_TOKEN='your-random-production-webhook-token'
```
---
## CONSUMING ASAAS API
**NOTE:** All responses are located in `/examples/responses` directory of package.
### CUSTOMERS - LIST
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\Customers\ListCustomers();
$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::list($resource);
dd($response);
```

---
### CUSTOMERS - CREATE
```php
$data = [
    'name' => 'Teste Usuario',
    'cpfCnpj' => sanitize("012.345.678-90"),
    'mobilePhone' => sanitize("(16) 99222-2222"),
    'email' => str("Teste@teste.com.br")->lower()->toString(),
];

$resource = new \TioJobs\AsaasPhp\Endpoints\Customers\CreateCustomer(data: $data);
$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::create($resource);

dd($response);
```
For more available fields look at `https://docs.asaas.com/reference/criar-novo-cliente`

---
### CUSTOMERS - GET
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\Customers\GetCustomer(id: 'cus_000005500564');
$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::get($resource);

dd($response);
```

---
### CUSTOMERS - FIND
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\Customers\FindCustomerByDocument(document: '01234567890');
$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::find($resource);

dd($response);
```

---
### CUSTOMERS - UPDATE
```php
$customerId = 'cus_000005824295';

$data = [
    'mobilePhone' => sanitize("(16) 99333-3333"),
];

$resource = new \TioJobs\AsaasPhp\Endpoints\Customers\UpdateCustomer(id: $customerId, data: $data);
$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::update($resource);

dd($response);
```
For more available fields look at `https://docs.asaas.com/reference/atualizar-cliente-existente`

---
### CUSTOMER - DELETE
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\Customers\DeleteCustomer(id: 'cus_000005824295');
$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::delete($resource);

dd($response);
```

---
### CUSTOMERS - RESTORE
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\Customers\RestoreCustomer(id: 'cus_000005824295');
$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::restore($resource);

dd($response);
```

---
### CUSTOMERS - NOTIFICATIONS
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\Customers\CustomerNotification(id: 'cus_000005824295');
$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::notifications($resource);

dd($response);
```

---
### CHARGES - DIRECT PAYMENT WITH BILLET
```php
$data = new \TioJobs\AsaasPhp\DataTransferObjects\Charges\Billet\DirectBilletDTO(
    customerId: 'cus_000005824295',
    value: 19.25,
);

$resource = new \TioJobs\AsaasPhp\Endpoints\Charges\Billet\DirectChargeByBillet(directBilletDTO: $data);
$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::charge($resource);

dd($response, $resource->getBilletUrl($response));
```

---
### CHARGES - CHARGE WITH DYNAMIC PIX
```php
$data = new \TioJobs\AsaasPhp\DataTransferObjects\Charges\Pix\DynamicPixDTO(
    customerId: 'cus_000005824295',
    value: 29.99,
);

$resource = new \TioJobs\AsaasPhp\Endpoints\Charges\Pix\ChargeByDynamicPix(dynamicPixDTO: $data);
$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::charge($resource);

dd($response, $resource->getPixPaymentData($response));
```

---
### CHARGES - CHARGE WITH STATIC PIX
```php
$data = new \TioJobs\AsaasPhp\DataTransferObjects\Charges\Pix\StaticPixDTO(
    description: 'Static Pix - Test Description',
    value: 19.90,
);

$resource = new \TioJobs\AsaasPhp\Endpoints\Charges\Pix\ChargeByStaticPix(staticPixDTO: $data);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::charge($resource);

dd($response);
```

---
### CHARGES - DIRECT CHARGE WITH CREDIT CARD
```php
$creditCardDTO = new \TioJobs\AsaasPhp\DataTransferObjects\Charges\CreditCard\CreditCardDTO(
    holderName: 'marcelo h almeida',
    number: '5162306219378829',
    expiryMonth: '05',
    expiryYear: '2024',
    ccv: '318',
);

$creditCardHolderInfoDTO = new \TioJobs\AsaasPhp\DataTransferObjects\Charges\CreditCard\CreditCardHolderInfoDTO(
    name: 'Marcelo Henrique Almeida',
    email: 'marcelo.almeida@gmail.com',
    document: '24971563792',
    postalCode: '89223-005',
    addressNumber: '277',
    phone: '4738010919',
    mobilePhone: '47998781877',
    addressComplement: '',
);

$directCreditCardDTO = new \TioJobs\AsaasPhp\DataTransferObjects\Charges\CreditCard\DirectCreditCardDTO(
    customerId: 'cus_000005824295',
    value: 29.99,
    creditCardDTO: $creditCardDTO,
    creditCardHolderInfoDTO: $creditCardHolderInfoDTO,
);

$resource = new \TioJobs\AsaasPhp\Endpoints\Charges\CreditCard\DirectChargeByCreditCard($directCreditCardDTO);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::charge($resource);

dd($response);
```

---
### CHARGES - PARTIAL CHARGE WITH CREDIT CARD
```php
$creditCardDTO = new \TioJobs\AsaasPhp\DataTransferObjects\Charges\CreditCard\CreditCardDTO(
    holderName: 'marcelo h almeida',
    number: '5162306219378829',
    expiryMonth: '05',
    expiryYear: '2024',
    ccv: '318',
);

$creditCardHolderInfoDTO = new \TioJobs\AsaasPhp\DataTransferObjects\Charges\CreditCard\CreditCardHolderInfoDTO(
    name: 'Marcelo Henrique Almeida',
    email: 'marcelo.almeida@gmail.com',
    document: '24971563792',
    postalCode: '89223-005',
    addressNumber: '277',
    phone: '4738010919',
    mobilePhone: '47998781877',
    addressComplement: '',
);

$partialCreditCardDTO = new \TioJobs\AsaasPhp\DataTransferObjects\Charges\CreditCard\PartialCreditCardDTO(
    customerId: 'cus_000005824295',
    value: 30.00,
    installments: 2,
    installmentValue: 15.00,
    creditCardDTO: $creditCardDTO,
    creditCardHolderInfoDTO: $creditCardHolderInfoDTO,
);

$resource = new \TioJobs\AsaasPhp\Endpoints\Charges\CreditCard\PartialChargeByCreditCard($partialCreditCardDTO);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::charge($resource);

dd($response);
```

---
### CHARGES - LIST ALL CHARGES
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\Charges\Resources\ListAllCharges(limit: 10, offset: 0);
$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::list($resource);

dd($response);
```

---
### CHARGES - DELETE CHARGE
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\Charges\Resources\DeleteCharge(id: 'pay_t7b3b3fvioxuqx4e');
$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::delete($resource);

dd($response);
```

---
### CHARGES - UPDATE CHARGE
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\Charges\Resources\UpdateCharge(
    id: 'pay_j875qgxq8ycbl42i',
    data: [
        'dueDate' => \Carbon\Carbon::now()->addDay()->format('Y-m-d'),
    ],
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::update($resource);

dd($response);
```

---
### CHARGES - UPLOAD DOCUMENT TO CHARGE
[POST] https://sandbox.asaas.com/api/v3/payments/{id}/documents
```php
$filePath = base_path('packages/tio-jobs/asaas-php/examples/files/test-document.pdf');
$fileName = str($filePath)->afterLast('/')->toString();

$resource = new \TioJobs\AsaasPhp\Endpoints\Charges\Resources\UploadChargeDocument(
    id: 'pay_j875qgxq8ycbl42i',
    data: [
        'availableAfterPayment' => true,
        'type' => \TioJobs\AsaasPhp\Enums\DocumentTypeEnum::DOCUMENT->value,
        attach(base_path('packages/tio-jobs/asaas-php/examples/files/test-document.pdf', 'file')),
    ],
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::upload($resource);

dd($response);
```

---
### CHARGES - DELETE UPLOADED CHARGE DOCUMENT
[DELETE] https://sandbox.asaas.com/api/v3/payments/{id}/documents/{documentId}
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\Charges\Resources\DeleteUploadedChargeDocument(
    id: 'pay_j875qgxq8ycbl42i',
    document: '4b052313-ec78-42ae-8374-42a1718aab75',
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::delete($resource);

dd($response);
```

---
### SUBACCOUNTS - CREATE SUBACCOUNT
```php
$subAccountDto = new \TioJobs\AsaasPhp\DataTransferObjects\SubAccounts\SubAccountDTO(
    name: 'Larissa e Helena Advocacia Ltda',
    email: 'financeiro@larissaehelenaadvocacialtda.com.br',
    document: '88.354.691/0001-72',
    companyType: \TioJobs\AsaasPhp\Enums\CompanyTypeEnum::INDIVIDUAL,
    mobilePhone: '(11) 99173-6850',
    postalCode: '14015-000',
    address: 'Rua Visconde do Rio Branco',
    addressNumber: '123',
    province: 'Centro',
    subAccountWebhooksDTO: new SubAccountWebhooksDTO(),
    complement: '',
    site: 'https://www.larissaehelenaadvocacialtda.com.br',
);

$resource = new \TioJobs\AsaasPhp\Endpoints\SubAccounts\CreateSubAccount(
    subAccountDTO: $subAccountDto,
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::create($resource);

dd($response);
```

---
### SUBACCOUNTS - CHECK PENDING DOCUMENTS
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\SubAccounts\CheckPendingDocuments(
    apiKey: '$aact_XXXX==',
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::get($resource);

dd($response);
```

---
### SUBACCOUNTS - UPLOAD PENDING DOCUMENTS

```php
$apiKey = '$aact_XXXX==';
$documentId = "b445460f-4bd5-41cc-8493-712b6e0966f2";

$resource = new \TioJobs\AsaasPhp\Endpoints\SubAccounts\UploadDocument(
    apiKey: $apiKey,
    documentId: $documentId,
    type: \TioJobs\AsaasPhp\Enums\FileDocumentTypeEnum::ENTREPRENEUR_REQUIREMENT,
    documentFile: attach(base_path('packages/tio-jobs/asaas-php/examples/files/test-document.pdf'), 'documentFile'),
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::upload($resource);

dd($response);
```

---
### SUBACCOUNTS - GET UPLOADED DOCUMENTS
```php
$apiKey = '$aact_XXXX==';
$documentId = "37106b34-21b6-497f-bb12-87d924b34b16"; // result of Upload Pending Document

$resource = new \TioJobs\AsaasPhp\Endpoints\SubAccounts\GetUploadedDocument(
    apiKey: $apiKey,
    documentId: $documentId,
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::get($resource);

dd($response);
```

---
### SUBACCOUNJTS - UPDATE UPLOADED DOCUMENT
```php
$apiKey = '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNzE5NDU6OiRhYWNoX2Q0MzY3M2Y3LTRlMWQtNGU0Ni1hYmUwLTExNTI5ZDgwMTVlNw==';

$resource = new \TioJobs\AsaasPhp\Endpoints\SubAccounts\UpdateUploadedDocument(
    documentId: '09f4903c-55fe-452e-bd4e-129780143214',
    documentFile: attach(base_path('packages/tio-jobs/asaas-php/examples/files/test-document.pdf'), 'documentFile'),
    apiKey: $apiKey,
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::update(
    $resource,
    $apiKey,
);

dd($response);
```

---
### SUBACCOUNTS - DELETE UPLOADED DOCUMENT
```php
$apiKey = '$aact_XXXX==';
$documentId = '09f4903c-55fe-452e-bd4e-129780143214';

$resource = new \TioJobs\AsaasPhp\Endpoints\SubAccounts\DeleteUploadedDocument(
    documentId: $documentId,
    apiKey: $apiKey,
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::delete($resource);

dd($response);
```

---
### BANK SERVICES - BANK STATEMENT
To see all bank-statement types refer to https://docs.asaas.com/reference/recuperar-extrato

```php
$apiKey = '$aact_XXXX==';

$resource = new \TioJobs\AsaasPhp\Endpoints\BankServices\GetBankStatement(
    apiKey: $apiKey,
    startDate: now()->subMonths(3)->format('Y-m-d'),
    endDate: now()->format('Y-m-d'),
    offset: 0,
    limit: 10,
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::get($resource);

dd($response);
```

---
### BANK SERVICES - TRANSFER TO OTHER BANK OR PIX KEY
```php
$apiKey = config('asaas-php.mode.sandbox.key');

$bankAccountDTO = new \TioJobs\AsaasPhp\DataTransferObjects\BankServices\BankAccountDTO(
    bankCode: '111',
    accountName: 'Conta do Bradesco Teste',
    ownerName: 'Larissa e Helena Advocacia Ltda',
    document: '01234567890',
    agency: '1111',
    accountNumber: '111111',
    accountDigit: '1',
    bankAccountTypeEnum: \TioJobs\AsaasPhp\Enums\BankAccountTypeEnum::CONTA_CORRENTE,
);

$resource = new \TioJobs\AsaasPhp\Endpoints\BankServices\OtherTransfer(
    apiKey: $apiKey,
    value: 10.00,
    operationTypeEnum: \TioJobs\AsaasPhp\Enums\OperationTypeEnum::TED,
    bankAccountDTO: $bankAccountDTO,
    pixKey: null,
    pixTypeEnum: null,
    descriptionForPix: null,
    scheduleDate: null, // if null, send immediately!
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::create($resource);

dd($response);
```

---
### BANK SERVICES - TRANSFER TO ASAAS ACCOUNT
```php
$apiKey = config('asaas-php.mode.sandbox.key');
$walletId = "a45e79db-36ab-48e2-a278-d438cf14329f";

$resource = new \TioJobs\AsaasPhp\Endpoints\BankServices\TransferToAsaas(
    apiKey: $apiKey,
    value: 49.90,
    walletId: $walletId,
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::create($resource);

dd($response);
```

---
### BANK SERVICES - GET TRANSFER
```php
$apiKey = config('asaas-php.mode.sandbox.key');
$transferId = "be0ae5ad-a93e-4f82-8e12-964e5303627a";

$resource = new \TioJobs\AsaasPhp\Endpoints\BankServices\GetTransfer(
    apiKey: $apiKey,
    transferId: $transferId,
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::get($resource);

dd($response);
```

---
### BANK SERVICES - GET ALL TRANSFERS
```php
$apiKey = config('asaas-php.mode.sandbox.key');

$resource = new \TioJobs\AsaasPhp\Endpoints\BankServices\GetAllTransfers(
    apiKey: $apiKey,
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::list($resource);

dd($response);
```

---
### NOTIFICATIONS - UPDATE NOTIFICATION
```php
$apiKey = config('asaas-php.mode.sandbox.key');
$notificationId = "not_3xd6o7qmx475t333";

$resource = new \TioJobs\AsaasPhp\Endpoints\Notifications\UpdateNotification(
    apiKey: $apiKey,
    notificationId: $notificationId,
    updateNotificationDTO: new \TioJobs\AsaasPhp\DataTransferObjects\Notifications\UpdateNotificationDTO(
        enabled: false,
        emailEnabledForProvider: false,
        smsEnabledForProvider: false,
        emailEnabledForCustomer: true,
        smsEnabledForCustomer: true,
        phoneCallEnabledForCustomer: false,
        whatsappEnabledForCustomer: true,
        //scheduleOffset: \TioJobs\AsaasPhp\Enums\ScheduleOffsetEnum::FIVE, // only valid to PAYMENT_DUEDATE_WARNING
    ),
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::update($resource);

dd($response);
```

### NOTIFICATIONS - BATCH UPDATE NOTIFICATIONS
```php
$apiKey = config('asaas-php.mode.sandbox.key');
    $customerId = "cus_000005824295";

    $notification1 = new \TioJobs\AsaasPhp\DataTransferObjects\Notifications\UpdateNotificationDTO(
        notificationId: 'not_3xd6o7qmx475t333',
        enabled: false,
        emailEnabledForProvider: false,
        smsEnabledForProvider: false,
        emailEnabledForCustomer: true,
        smsEnabledForCustomer: true,
        phoneCallEnabledForCustomer: false,
        whatsappEnabledForCustomer: true,
        //scheduleOffset: \TioJobs\AsaasPhp\Enums\ScheduleOffsetEnum::FIVE, // only valid to PAYMENT_DUEDATE_WARNING
    );

    $notification2 = new \TioJobs\AsaasPhp\DataTransferObjects\Notifications\UpdateNotificationDTO(
        notificationId: 'not_622b0ypi6ocj6ss4',
        enabled: false,
        emailEnabledForProvider: false,
        smsEnabledForProvider: false,
        emailEnabledForCustomer: true,
        smsEnabledForCustomer: true,
        phoneCallEnabledForCustomer: false,
        whatsappEnabledForCustomer: true,
        //scheduleOffset: \TioJobs\AsaasPhp\Enums\ScheduleOffsetEnum::FIVE, // only valid to PAYMENT_DUEDATE_WARNING
    );

    $resource = new \TioJobs\AsaasPhp\Endpoints\Notifications\BatchUpdateNotifications(
        apiKey: $apiKey,
        customerId: $customerId,
    );

    $resource->addNotification($notification1);
    $resource->addNotification($notification2);

    $response = \TioJobs\AsaasPhp\Facades\AsaasPhp::update($resource);

    dd($response);
```

---
### WEBHOOKS
We strongly recommend the `https://pipedream.com/` (logged with github) to configure your `ASAAS_SANDBOX_WEBHOOK_URL`.

For `ASAAS_PRODUCTION_WEBHOOK_URL`, you can create a POST route in `routes/api.php`, for example:
```php
Route::post('/webhooks/asaas', function (Request $request) {
    // your business logic here!
    \Illuminate\Support\Facades\Log::info('/webhooks/asaas', $request->all());
});
```

---
### CONTRIBUTING - STEP BY STEP
1. Fork this project on your github account
2. Clone the forked project on your local environment
3. So now, you can install dependencies and activate the hooks:
```bash
composer install
 
```

Running code style manually:
```bash
./vendor/bin/php-cs-fixer fix --diff
```