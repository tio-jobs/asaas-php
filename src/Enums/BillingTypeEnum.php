<?php

namespace TioJobs\AsaasPhp\Enums;

enum BillingTypeEnum: string
{
    case BILLET = 'BOLETO';
    case CREDIT_CARD = 'CREDIT_CARD';
    case PIX = 'PIX';
}
