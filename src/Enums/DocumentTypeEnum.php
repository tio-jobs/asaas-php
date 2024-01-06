<?php

namespace TioJobs\AsaasPhp\Enums;

enum DocumentTypeEnum: string
{
    case INVOICE = 'INVOICE';
    case CONTRACT = 'CONTRACT';
    case MEDIA = 'MEDIA';
    case DOCUMENT = 'DOCUMENT';
    case SPREADSHEET = 'SPREADSHEET';
    case PROGRAM = 'PROGRAM';
    case OTHER = 'OTHER';
}
