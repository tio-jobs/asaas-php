# ASAAS PHP
This `Laravel Package` was created abstracting `ASAAS Payment Gateway` endpoints and allow to work with both, main and sub account!

[ASAAS API REFERENCE](https://docs.asaas.com/reference/comece-por-aqui)
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
`note:`This package isn't production ready yet! So, the first step, change your `composer.json` to:
```json
"minimum-stability": "dev",
```

So now, you can install the beta-version with the following command:
```bash
composer require tio-jobs/asaas-php

# or

composer require tio-jobs/asaas-php:v0.2.0-beta
```

---
### PUBLISHING CONFIGURATION FILE
To publish the config file just type:
```bash
php artisan vendor:publish

# then search by AsaasPhpServiceProvider and hit [ENTER]
```

---
### CHANGING THE .ENV FILE
Add the API KEY constant in your .env file (with single quotes):
```bash
ASAAS_API_VERSION=v3

ASAAS_SANDBOX_BASE_URL=https://sandbox.asaas.com/api/
ASAAS_SANDBOX_API_KEY='your-sandbox-key'
ASAAS_SANDBOX_PIX_KEY=your-sandbox-pix-key
ASAAS_SANDBOX_EMAIL_ACCOUNT='your-sandbox-email'
ASAAS_SANDBOX_WEBHOOK_URL='your-sandbox-webhook-url'
ASAAS_SANDBOX_WEBHOOK_TOKEN='your-random-sandbox-webhook-token'

ASAAS_PRODUCTION_BASE_URL=https://api.asaas.com/
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

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->customer()->list();

dd($response);
```

---
### CUSTOMERS - CREATE
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->customer()->create(
    name: 'Teste Usuario',
    cpfCnpj: sanitize("012.345.678-90"),
    email: str("Teste@teste.com.br")->lower()->toString(),
    mobilePhone: sanitize("(16) 99222-2222")
);

dd($response);
```
For more available fields look at `https://docs.asaas.com/reference/criar-novo-cliente`

---
### CUSTOMERS - GET
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->customer()->get(id: 'cus_000005500564');

dd($response);
```

---
### CUSTOMERS - FIND
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->customer()->findByDocument(document: '01234567890');

dd($response);
```

---
### CUSTOMERS - UPDATE
Here an example of mobile phone update using the `asaas-php`:
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->customer()->update(id: 'cus_000005824295', mobilePhone: sanitize("(16) 99333-3333"));

dd($response);
```
For more available fields look at `https://docs.asaas.com/reference/atualizar-cliente-existente`

---
### CUSTOMER - DELETE
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->customer()->delete(id: 'cus_000005824295');

dd($response);
```

---
### CUSTOMERS - RESTORE
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->customer()->restore(id: 'cus_000005824295',);

dd($response);
```

---
### CUSTOMERS - NOTIFICATIONS
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->customer()->notifications( id: 'cus_000005824295',);

dd($response);
```

---
### CHARGES - DIRECT PAYMENT WITH BILLET
```php
$data = new \TioJobs\AsaasPhp\DataTransferObjects\Charges\Billet\DirectBilletDTO(
    customerId: 'cus_000005824295',
    value: 19.25,
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->charge()->directByBillet(DTO: $data);

dd($response, $resource->getBilletUrl($response));
```

---
### CHARGES - CHARGE WITH DYNAMIC PIX
```php
$data = new \TioJobs\AsaasPhp\DataTransferObjects\Charges\Pix\DynamicPixDTO(
    customerId: 'cus_000005824295',
    value: 29.99,
);


$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->charge()->pixDynamic(DTO: $data);

dd($response, $resource->getPixPaymentData($response));
```

---
### CHARGES - CHARGE WITH STATIC PIX
```php
$data = new \TioJobs\AsaasPhp\DataTransferObjects\Charges\Pix\StaticPixDTO(
    description: 'Static Pix - Test Description',
    value: 19.90,
);


$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->charge()->pixStatic(DTO: $data); 

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

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->charge()->directByCreditCard(DTO: $directCreditCardDTO);

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


$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->charge()->partialCreditCard(DTO: $partialCreditCardDTO);

dd($response);
```

---
### CHARGES - LIST ALL CHARGES
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->charge()->all(limit: 10, offset: 0);

dd($response);
```

---
### CHARGES - DELETE CHARGE
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->charge()->delete( id: 'pay_t7b3b3fvioxuqx4e',);

dd($response);
```

---
### CHARGES - UPDATE CHARGE
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->charge()->update(
    id: 'pay_j875qgxq8ycbl42i',
    data: [
        'dueDate' => \Carbon\Carbon::now()->addDay()->format('Y-m-d'),
    ],
);

dd($response);
```

---
### CHARGES - UPLOAD DOCUMENT TO CHARGE
[POST] https://sandbox.asaas.com/api/v3/payments/{id}/documents
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->charge()->uploadDocument(
    id: 'pay_j875qgxq8ycbl42i',
    data: [
        'availableAfterPayment' => true,
        'type' => \TioJobs\AsaasPhp\Enums\DocumentTypeEnum::DOCUMENT->value,
        attach(filePath: base_path('packages/tio-jobs/asaas-php/examples/files/test-document.pdf'), fieldName: 'file')),
    ],
);

dd($response);
```

---
### CHARGES - DELETE UPLOADED CHARGE DOCUMENT
[DELETE] https://sandbox.asaas.com/api/v3/payments/{id}/documents/{documentId}
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->charge()->deleteDocument( id: 'pay_j875qgxq8ycbl42i', document: '4b052313-ec78-42ae-8374-42a1718aab75',);

dd($response);
```

---
### SUBACCOUNTS - CREATE SUBACCOUNT
`note:` For personal account using CPF, the field `birthDate`is required.
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

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->subAccount()->create(DTO: $subAccountDto);

dd($response);
```

---
### SUBACCOUNTS - LIST SUBACCOUNTS
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->subAccount()->all()

dd($response);
```

---
### SUBACCOUNTS - CHECK PENDING DOCUMENTS
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->subAccount()->checkPendingDocuments()

dd($response);
```

---
### SUBACCOUNTS - UPLOAD PENDING DOCUMENTS

```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->subAccount()->updateDocument(
    documentId: 'b445460f-4bd5-41cc-8493-712b6e0966f2',
    type: \TioJobs\AsaasPhp\Enums\FileDocumentTypeEnum::ENTREPRENEUR_REQUIREMENT,
    documentFile: attach(base_path('packages/tio-jobs/asaas-php/examples/files/test-document.pdf'), 'documentFile'),
)

dd($response);
```

---
### SUBACCOUNTS - GET UPLOADED DOCUMENTS
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->subAccount()->getDocument(documentId: '37106b34-21b6-497f-bb12-87d924b34b16');

dd($response);
```

---
### SUBACCOUNJTS - UPDATE UPLOADED DOCUMENT
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->subAccount()->updateDocument(
    documentId: '09f4903c-55fe-452e-bd4e-129780143214',
    documentFile: attach(filePath: base_path('packages/tio-jobs/asaas-php/examples/files/test-document.pdf'), fieldName: 'documentFile'),
);

dd($response);
```

---
### SUBACCOUNTS - DELETE UPLOADED DOCUMENT
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->subAccount()->deleteDocument( documentId: '09f4903c-55fe-452e-bd4e-129780143214',);

dd($response);
```

---
### BANK SERVICES - BANK STATEMENT
To see all bank-statement types refer to https://docs.asaas.com/reference/recuperar-extrato

```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->bank()->getStatement(
    startDate: now()->subMonths(3)->format('Y-m-d'),
    endDate: now()->format('Y-m-d'),
    offset: 0,
    limit: 10,
);

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

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->bank()->otherTransfer(
    value: 10.00,
    operationTypeEnum: \TioJobs\AsaasPhp\Enums\OperationTypeEnum::TED,
    bankAccountDTO: $bankAccountDTO,
    pixKey: null,
    pixTypeEnum: null,
    descriptionForPix: null,
    scheduleDate: null, // if null, send immediately!
)

dd($response);
```

---
### BANK SERVICES - TRANSFER TO ASAAS ACCOUNT
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->bank()->transferToAsaas( walletId: 'a45e79db-36ab-48e2-a278-d438cf14329f', value: 49.90,);

dd($response);
```

---
### BANK SERVICES - GET TRANSFER
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->bank()->getTransfer(transferId: 'be0ae5ad-a93e-4f82-8e12-964e5303627a');

dd($response);
```

---
### BANK SERVICES - GET ALL TRANSFERS
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->bank()->getAllTransfers();

dd($response);
```

---
### NOTIFICATIONS - UPDATE NOTIFICATION
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->notifications()->update(
    notificationId: 'not_3xd6o7qmx475t333',
    DTO: new \TioJobs\AsaasPhp\DataTransferObjects\Notifications\UpdateNotificationDTO(
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

dd($response);
```

### NOTIFICATIONS - BATCH UPDATE NOTIFICATIONS
```php
$notifications = [
    new \TioJobs\AsaasPhp\DataTransferObjects\Notifications\UpdateNotificationDTO(
    notificationId: 'not_3xd6o7qmx475t333',
    enabled: false,
    emailEnabledForProvider: false,
    smsEnabledForProvider: false,
    emailEnabledForCustomer: true,
    smsEnabledForCustomer: true,
    phoneCallEnabledForCustomer: false,
    whatsappEnabledForCustomer: true,
    //scheduleOffset: \TioJobs\AsaasPhp\Enums\ScheduleOffsetEnum::FIVE, // only valid to PAYMENT_DUEDATE_WARNING
),
    new \TioJobs\AsaasPhp\DataTransferObjects\Notifications\UpdateNotificationDTO(
        notificationId: 'not_622b0ypi6ocj6ss4',
        enabled: false,
        emailEnabledForProvider: false,
        smsEnabledForProvider: false,
        emailEnabledForCustomer: true,
        smsEnabledForCustomer: true,
        phoneCallEnabledForCustomer: false,
        whatsappEnabledForCustomer: true,
        //scheduleOffset: \TioJobs\AsaasPhp\Enums\ScheduleOffsetEnum::FIVE, // only valid to PAYMENT_DUEDATE_WARNING
    )
];

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->notifications()->batchUpdate(
     customerId: 'cus_000005824295',
     DTO: $notifications
);

dd($response);
```

---
### COVERAGE TESTS
*CORE - Asaas Core Class*
[] check list method
[] check create method
[] check get method
[] check find method
[] check update method
[] check delete method
[] check restore method
[] check notifications method
[] check charge method
[] check upload method

*CORE - AsaasPhp Facade*
[x] check if facade returns the Asaas.php core class

*CUSTOMERS*
[x] Create Customer
[x] Customer Notification
[x] Delete Customer
[x] Find Customer by Document
[x] Get Customer
[x] List Customer
[x] Restore Customer
[x] Update Customer

*CHARGES - BILLET*
[x]

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