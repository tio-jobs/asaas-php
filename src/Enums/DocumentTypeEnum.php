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

    public function getLabel(): ?string
    {
        return match ($this) {
            self::INVOICE => 'INVOICE',
            self::CONTRACT => 'CONTRACT',
            self::MEDIA => 'MEDIA',
            self::DOCUMENT => 'DOCUMENT',
            self::SPREADSHEET => 'SPREADSHEET',
            self::PROGRAM => 'PROGRAM',
            self::OTHER => 'OTHER',
        };
    }
}
