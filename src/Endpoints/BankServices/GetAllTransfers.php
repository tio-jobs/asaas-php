<?php

namespace TioJobs\AsaasPhp\Endpoints\BankServices;

use TioJobs\AsaasPhp\Concerns\HasBlankData;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class GetAllTransfers implements AsaasInterface
{
    use HasBlankData;

    public function getPath(): string
    {
        return 'transfers';
    }
}
