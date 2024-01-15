<?php

namespace TioJobs\AsaasPhp\Enums;

enum CompanyTypeEnum: string
{
    case NONE = '';
    case MEI = 'MEI';
    case LIMITED = 'LIMITED';
    case INDIVIDUAL = 'INDIVIDUAL';
    case ASSOCIATION = 'ASSOCIATION';
}
