# ASAAS PHP

Este `Pacote Laravel` foi criado abstraindo os endpoints do `Gateway de Pagamento ASAAS` e permite trabalhar com a conta principal e subconta!

` 🇺🇸 ` This `Laravel Package` was created abstracting the Brazilian `ASAAS Payment Gateway` endpoints. The documentation is available in Portuguese (PT-BR) for ease of use of our targeted developers in Brazil. If you have any questions, please do not hesitate to open an issue or contact the author.

[ASAAS API REFERENCE](https://docs.asaas.com/reference/comece-por-aqui)

---

### SYSTEM REQUIREMENTS
- PHP 8.1+
- Composer 2+
- Laravel 10+

---
### OBTENDO A CHAVE DA API ASAAS
Para obter a CHAVE DA API ASAAS, você precisa acessar seu Perfil > Integrações.

---
### INSTALANDO O PACOTE
`nota:` Este pacote ainda não está pronto para produção! Então, o primeiro passo, altere seu `composer.json` para:
```json
"minimum-stability": "dev",
```

Agora, você pode instalar a versão beta com o seguinte comando:
```bash
composer require tio-jobs/asaas-php

# ou

composer require tio-jobs/asaas-php:v0.2.0-beta
```

---
### PUBLICANDO O ARQUIVO DE CONFIGURAÇÃO
Para publicar o arquivo de configuração, basta digitar:
```bash
php artisan vendor:publish

# então procure por AsaasPhpServiceProvider e pressione [ENTER]
```

---
### ALTERANDO O ARQUIVO .ENV
Adicione a constante da CHAVE DA API no seu arquivo .env (com aspas simples):
```bash
ASAAS_API_VERSION=v3

ASAAS_SANDBOX_BASE_URL=https://sandbox.asaas.com/api/
ASAAS_SANDBOX_API_KEY='sua-chave-sandbox'
ASAAS_SANDBOX_PIX_KEY=sua-chave-pix-sandbox
ASAAS_SANDBOX_EMAIL_ACCOUNT='seu-email-sandbox'
ASAAS_SANDBOX_WEBHOOK_URL='sua-url-webhook-sandbox'
ASAAS_SANDBOX_WEBHOOK_TOKEN='seu-token-webhook-sandbox-aleatório'

ASAAS_PRODUCTION_BASE_URL=https://api.asaas.com/
ASAAS_PRODUCTION_API_KEY='sua-chave-produção'
ASAAS_PRODUCTION_PIX_KEY=sua-chave-pix-produção
ASAAS_PRODUCTION_EMAIL_ACCOUNT='seu-email-produção'
ASAAS_PRODUCTION_WEBHOOK_URL='sua-url-webhook-produção'
ASAAS_PRODUCTION_WEBHOOK_TOKEN='seu-token-webhook-produção-aleatório'
ASAAS_ALLOW_SUB_ACCOUNTS=false # Quando FALSE, carrega automaticamente a chave da API do .env; do contrário a mesma deverá no código
```

---
## CONSUMINDO A API ASAAS
**NOTA:** Todas as respostas estão localizadas no diretório \tests\Fixtures\responses.
### CLIENTES - LISTAR
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->customer()->list();

dd($response);
```

---
### CLIENTES - CRIAR
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->customer()->create(
    name: 'Teste Usuário',
    cpfCnpj: sanitize("012.345.678-90"),
    email: str("Teste@teste.com.br")->lower()->toString(),
    mobilePhone: sanitize("(16) 99222-2222")
);

dd($response);
```
Para mais campos disponíveis, consulte: [https://docs.asaas.com/reference/criar-novo-cliente](https://docs.asaas.com/reference/criar-novo-cliente)

---
### CLIENTES - OBTER
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->customer()->get(id: 'cus_000005500564');

dd($response);
```

---
### CLIENTES - ENCONTRAR
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->customer()->findByDocument(document: '01234567890');

dd($response);
```

---
### CLIENTES - ATUALIZAR
Aqui um exemplo de atualização de telefone móvel usando o `asaas-php`:
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->customer()->update(id: 'cus_000005824295', mobilePhone: sanitize("(11) 91111-1111"));

dd($response);
```
Para mais campos disponíveis, consulte: [https://docs.asaas.com/reference/atualizar-cliente-existente](https://docs.asaas.com/reference/atualizar-cliente-existente)

---
### CLIENTE - DELETAR
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->customer()->delete(id: 'cus_000005824295');

dd($response);
```

---
### CLIENTES - RESTAURAR
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->customer()->restore(id: 'cus_000005824295',);

dd($response);
```

---
### CLIENTES - NOTIFICAÇÕES
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->customer()->notifications( id: 'cus_000005824295',);

dd($response);
```

---
### COBRANÇAS - PAGAMENTO DIRETO COM BOLETO
```php
$data = new \TioJobs\AsaasPhp\DataTransferObjects\Charges\Billet\DirectBilletDTO(
    customerId: 'cus_000005824295',
    value: 19.25,
);

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->charge()->directByBillet(DTO: $data);

dd($response, $resource->getBilletUrl($response));
```

---
### COBRANÇAS - COBRANÇA COM PIX DINÂMICO
```php
$data = new \TioJobs\AsaasPhp\DataTransferObjects\Charges\Pix\DynamicPixDTO(
    customerId: 'cus_000005824295',
    value: 29.99,
);


$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->charge()->pixDynamic(DTO: $data);

dd($response, $resource->getPixPaymentData($response));
```

---
### COBRANÇAS - COBRANÇA COM PIX ESTÁTICO
```php
$data = new \TioJobs\AsaasPhp\DataTransferObjects\Charges\Pix\StaticPixDTO(
    description: 'Pix Estático - Descrição do Teste',
    value: 19.90,
);


$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->charge()->pixStatic(DTO: $data); 

dd($response);
```

---
### COBRANÇAS - COBRANÇA DIRETA COM CARTÃO DE CRÉDITO
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
### COBRANÇAS - COBRANÇA PARCIAL COM CARTÃO DE CRÉDITO
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
### COBRANÇAS - LISTAR TODAS AS COBRANÇAS
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->charge()->all(limit: 10, offset: 0);

dd($response);
```

---
### COBRANÇAS - DELETAR COBRANÇA
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->charge()->delete( id: 'pay_t7b3b3fvioxuqx4e',);

dd($response);
```

---
### COBRANÇAS - ATUALIZAR COBRANÇA
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
### COBRANÇAS - ENVIAR DOCUMENTO PARA COBRANÇA
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
### COBRANÇAS - DELETAR DOCUMENTO ENVIADO PARA COBRANÇA
[DELETE] https://sandbox.asaas.com/api/v3/payments/{id}/documents/{documentId}
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->charge()->deleteDocument( id: 'pay_j875qgxq8ycbl42i', document: '4b052313-ec78-42ae-8374-42a1718aab75',);

dd($response);
```

---
### SUBCONTAS - CRIAR SUBCONTA
`nota:` Para conta pessoal usando CPF, o campo `birthDate` é obrigatório.
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
### SUBCONTAS - LISTAR SUBCONTAS
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->subAccount()->all()

dd($response);
```

---
### SUBCONTAS - VERIFICAR DOCUMENTOS PENDENTES
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->subAccount()->checkPendingDocuments()

dd($response);
```

---
### SUBCONTAS - ENVIAR DOCUMENTOS PENDENTES

```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->subAccount()->updateDocument(
    documentId: 'b445460f-4bd5-41cc-8493-712b6e0966f2',
    type: \TioJobs\AsaasPhp\Enums\FileDocumentTypeEnum::ENTREPRENEUR_REQUIREMENT,
    documentFile: attach(base_path('packages/tio-jobs/asaas-php/examples/files/test-document.pdf'), 'documentFile'),
)

dd($response);
```

---
### SUBCONTAS - OBTER DOCUMENTOS ENVIADOS
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->subAccount()->getDocument(documentId: '37106b34-21b6-497f-bb12-87d924b34b16');

dd($response);
```

---
### SUBCONTAS - ATUALIZAR DOCUMENTO ENVIADO
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->subAccount()->updateDocument(
    documentId: '09f4903c-55fe-452e-bd4e-129780143214',
    documentFile: attach(filePath: base_path('packages/tio-jobs/asaas-php/examples/files/test-document.pdf'), fieldName: 'documentFile'),
);

dd($response);
```

---
### SUBCONTAS - DELETAR DOCUMENTO ENVIADO
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->subAccount()->deleteDocument( documentId: '09f4903c-55fe-452e-bd4e-129780143214',);

dd($response);
```

---
### SERVIÇOS BANCÁRIOS - EXTRATO BANCÁRIO
Para ver todos os tipos de extrato bancário, consulte: [https://docs.asaas.com/reference/recuperar-extrato](https://docs.asaas.com/reference/recuperar-extrato)

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
### SERVIÇOS BANCÁRIOS - TRANSFERIR PARA OUTRO BANCO OU CHAVE PIX
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
### SERVIÇOS BANCÁRIOS - TRANSFERIR PARA CONTA ASAAS
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->bank()->transferToAsaas( walletId: 'a45e79db-36ab-48e2-a278-d438cf14329f', value: 49.90,);

dd($response);
```

---
### SERVIÇOS BANCÁRIOS - OBTER TRANSFERÊNCIA
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->bank()->getTransfer(transferId: 'be0ae5ad-a93e-4f82-8e12-964e5303627a');

dd($response);
```

---
### SERVIÇOS BANCÁRIOS - OBTER TODAS AS TRANSFERÊNCIAS
```php

$response = \TioJobs\AsaasPhp\Facades\AsaasPhp::make()->bank()->getAllTransfers();

dd($response);
```

---
### NOTIFICAÇÕES - ATUALIZAR NOTIFICAÇÃO
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

### NOTIFICAÇÕES - ATUALIZAÇÃO EM LOTE DE NOTIFICAÇÕES
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
### TESTES DE COBERTURA
*CORE - Asaas Core Class*
[] verificar método de listagem 
[] verificar método de criação 
[] verificar método de obtenção 
[] verificar método de busca 
[] verificar método de atualização 
[] verificar método de exclusão 
[] verificar método de restauração 
[] verificar método de notificações 
[] verificar método de cobrança 
[] verificar método de upload

*CORE - AsaasPhp Facade*
[x] verificar se a facade retorna a classe core Asaas.php

*CLIENTES*
[x] Criar Cliente 
[x] Notificação do Cliente 
[x] Excluir Cliente 
[x] Encontrar Cliente por Documento 
[x] Obter Cliente 
[x] Listar Cliente 
[x] Restaurar Cliente 
[x] Atualizar Cliente

*COBRANÇAS - BOLETO*
[x]

---
### WEBHOOKS
Recomendamos fortemente o [https://pipedream.com/](https://pipedream.com/) (logado com github) para configurar seu `ASAAS_SANDBOX_WEBHOOK_URL`.

Para `ASAAS_PRODUCTION_WEBHOOK_URL`,você pode criar uma rota POST em `routes/api.php`, por exemplo:
```php
Route::post('/webhooks/asaas', function (Request $request) {
    // your business logic here!
    \Illuminate\Support\Facades\Log::info('/webhooks/asaas', $request->all());
});
```

## CONTRIBUTING

Contribuições são bem vindas. Por favor leia nossas [diretrizes de contribuição](CONTRIBUTING.md) (em inglês).

## CREDITS

By [Icaro William](https://github.com/icarojobs) and [contributors](https://github.com/tio-jobs/asaas-php/graphs/contributors).
