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
$resource = new \TioJobs\AsaasPhp\Endpoints\Customers\CreateCustomer(
    apiKey: config('asaas-php.mode.sandbox.key'),
    name: 'Teste Usuario',
    cpfCnpj: sanitize("012.345.678-90"),
    email: str("Teste@teste.com.br")->lower()->toString(),
    mobilePhone: sanitize("(16) 99222-2222"),
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::create($resource);

dd($response);
```
For more available fields look at `https://docs.asaas.com/reference/criar-novo-cliente`

---
### CUSTOMERS - GET
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\Customers\GetCustomer(
    apiKey: config('asaas-php.mode.sandbox.key'),
    id: 'cus_000005500564',
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::get($resource);

dd($response);
```

---
### CUSTOMERS - FIND
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\Customers\FindCustomerByDocument(
    apiKey: config('asaas-php.mode.sandbox.key'),
    document: '01234567890',
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::find($resource);

dd($response);
```

---
### CUSTOMERS - UPDATE
Here an example of mobile phone update using the `asaas-php`:
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\Customers\UpdateCustomer(
    apiKey: config('asaas-php.mode.sandbox.key'),
    id: 'cus_000005824295',
    mobilePhone: sanitize("(16) 99333-3333"),
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::update($resource);

dd($response);
```
For more available fields look at `https://docs.asaas.com/reference/atualizar-cliente-existente`

---
### CUSTOMER - DELETE
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\Customers\DeleteCustomer(
    apiKey: config('asaas-php.mode.sandbox.key'),
    id: 'cus_000005824295',
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::delete($resource);

dd($response);
```

---
### CUSTOMERS - RESTORE
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\Customers\RestoreCustomer(
    apiKey: config('asaas-php.mode.sandbox.key'),
    id: 'cus_000005824295',
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::restore($resource);

dd($response);
```

---
### CUSTOMERS - NOTIFICATIONS
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\Customers\CustomerNotification(
    apiKey: config('asaas-php.mode.sandbox.key'),
    id: 'cus_000005824295',
);

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

$resource = new \TioJobs\AsaasPhp\Endpoints\Charges\Billet\DirectChargeByBillet(
    apiKey: config('asaas-php.mode.sandbox.key'),
    directBilletDTO: $data,
);

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

$resource = new \TioJobs\AsaasPhp\Endpoints\Charges\Pix\ChargeByDynamicPix(
    apiKey: config('asaas-php.mode.sandbox.key'),
    dynamicPixDTO: $data,
);

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

$resource = new \TioJobs\AsaasPhp\Endpoints\Charges\Pix\ChargeByStaticPix(
    apiKey: config('asaas-php.mode.sandbox.key'),
    staticPixDTO: $data,
);

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

$resource = new \TioJobs\AsaasPhp\Endpoints\Charges\CreditCard\DirectChargeByCreditCard(
    apiKey: config('asaas-php.mode.sandbox.key'), 
    directCreditCardDTO: $directCreditCardDTO,
);

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

$resource = new \TioJobs\AsaasPhp\Endpoints\Charges\CreditCard\PartialChargeByCreditCard(
    apiKey: config('asaas-php.mode.sandbox.key'), 
    partialCreditCardDTO: $partialCreditCardDTO,
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::charge($resource);

dd($response);
```

---
### CHARGES - LIST ALL CHARGES
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\Charges\Resources\ListAllCharges(
    apiKey: config('asaas-php.mode.sandbox.key'),
    limit: 10, 
    offset: 0,
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::list($resource);

dd($response);
```

---
### CHARGES - DELETE CHARGE
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\Charges\Resources\DeleteCharge(
    apiKey: config('asaas-php.mode.sandbox.key'),
    id: 'pay_t7b3b3fvioxuqx4e',
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::delete($resource);

dd($response);
```

---
### CHARGES - UPDATE CHARGE
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\Charges\Resources\UpdateCharge(
    apiKey: config('asaas-php.mode.sandbox.key'),
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
$resource = new \TioJobs\AsaasPhp\Endpoints\Charges\Resources\UploadChargeDocument(
    apiKey: config('asaas-php.mode.sandbox.key'),
    id: 'pay_j875qgxq8ycbl42i',
    data: [
        'availableAfterPayment' => true,
        'type' => \TioJobs\AsaasPhp\Enums\DocumentTypeEnum::DOCUMENT->value,
        attach(filePath: base_path('packages/tio-jobs/asaas-php/examples/files/test-document.pdf'), fieldName: 'file')),
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
    apiKey: config('asaas-php.mode.sandbox.key'),
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
    apiKey: config('asaas-php.mode.sandbox.key'),
    subAccountDTO: $subAccountDto,
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::create($resource);

dd($response);
```

---
### SUBACCOUNTS - CHECK PENDING DOCUMENTS
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\SubAccounts\CheckPendingDocuments(
    apiKey: config('asaas-php.mode.sandbox.key'),
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::get($resource);

dd($response);
```

---
### SUBACCOUNTS - UPLOAD PENDING DOCUMENTS

```php
$resource = new \TioJobs\AsaasPhp\Endpoints\SubAccounts\UploadDocument(
    apiKey: config('asaas-php.mode.sandbox.key'),
    documentId: 'b445460f-4bd5-41cc-8493-712b6e0966f2',
    type: \TioJobs\AsaasPhp\Enums\FileDocumentTypeEnum::ENTREPRENEUR_REQUIREMENT,
    documentFile: attach(base_path('packages/tio-jobs/asaas-php/examples/files/test-document.pdf'), 'documentFile'),
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::upload($resource);

dd($response);
```

---
### SUBACCOUNTS - GET UPLOADED DOCUMENTS
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\SubAccounts\GetUploadedDocument(
    apiKey: config('asaas-php.mode.sandbox.key'),
    documentId: '37106b34-21b6-497f-bb12-87d924b34b16', // result of Upload Pending Document
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::get($resource);

dd($response);
```

---
### SUBACCOUNJTS - UPDATE UPLOADED DOCUMENT
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\SubAccounts\UpdateUploadedDocument(
    apiKey: config('asaas-php.mode.sandbox.key'),
    documentId: '09f4903c-55fe-452e-bd4e-129780143214',
    documentFile: attach(filePath: base_path('packages/tio-jobs/asaas-php/examples/files/test-document.pdf'), fieldName: 'documentFile'),
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::update($resource);

dd($response);
```

---
### SUBACCOUNTS - DELETE UPLOADED DOCUMENT
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\SubAccounts\DeleteUploadedDocument(
    apiKey: config('asaas-php.mode.sandbox.key'),
    documentId: '09f4903c-55fe-452e-bd4e-129780143214',
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::delete($resource);

dd($response);
```

---
### BANK SERVICES - BANK STATEMENT
To see all bank-statement types refer to https://docs.asaas.com/reference/recuperar-extrato

```php
$resource = new \TioJobs\AsaasPhp\Endpoints\BankServices\GetBankStatement(
    apiKey: config('asaas-php.mode.sandbox.key'),
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
    apiKey: config('asaas-php.mode.sandbox.key'),
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
$resource = new \TioJobs\AsaasPhp\Endpoints\BankServices\TransferToAsaas(
    apiKey: config('asaas-php.mode.sandbox.key'),
    walletId: 'a45e79db-36ab-48e2-a278-d438cf14329f',
    value: 49.90,
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::create($resource);

dd($response);
```

---
### BANK SERVICES - GET TRANSFER
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\BankServices\GetTransfer(
    apiKey: config('asaas-php.mode.sandbox.key'),
    transferId: 'be0ae5ad-a93e-4f82-8e12-964e5303627a',
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::get($resource);

dd($response);
```

---
### BANK SERVICES - GET ALL TRANSFERS
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\BankServices\GetAllTransfers(
    apiKey: config('asaas-php.mode.sandbox.key'),
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::list($resource);

dd($response);
```

---
### NOTIFICATIONS - UPDATE NOTIFICATION
```php
$resource = new \TioJobs\AsaasPhp\Endpoints\Notifications\UpdateNotification(
    apiKey: config('asaas-php.mode.sandbox.key'),
    notificationId: 'not_3xd6o7qmx475t333',
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
    apiKey: config('asaas-php.mode.sandbox.key'),
    customerId: 'cus_000005824295',
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
4. Activate all the hooks:
```bash
./vendor/bin/captainhook install -f -s
```
5. Copy the `phpunit.xml.dist` to `phpunit.xml` with your desired variables on bottom file.
6. Enjoy it!

Running code style manually:
```bash
./vendor/bin/php-cs-fixer fix --diff
```

Running code analysis manually:
```bash
./vendor/bin/phpstan analyse --memory-limit=2G
```