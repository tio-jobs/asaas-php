<?php

namespace TioJobs\AsaasPhp\Enums;

enum PixTypeEnum: string
{
    case CPF = 'CPF';
    case CNPJ = 'CNPJ';
    case EMAIL = 'EMAIL';
    case PHONE = 'PHONE';
    case EVP = 'EVP';
}
