<?php

namespace TioJobs\AsaasPhp\Enums;

enum FileDocumentTypeEnum: string
{
    case IDENTIFICATION = 'IDENTIFICATION';
    case SOCIAL_CONTRACT = 'SOCIAL_CONTRACT';
    case ENTREPRENEUR_REQUIREMENT = 'ENTREPRENEUR_REQUIREMENT';
    case MINUTES_OF_ELECTION = 'MINUTES_OF_ELECTION';
    case CUSTOM = 'CUSTOM';
}
