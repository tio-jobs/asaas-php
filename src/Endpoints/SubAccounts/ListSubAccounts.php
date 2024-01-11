<?php

namespace TioJobs\AsaasPhp\Endpoints\SubAccounts;

use TioJobs\AsaasPhp\Concerns\HasBlankData;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class ListSubAccounts implements AsaasInterface
{
    use HasBlankData;

    public function getPath(): string
    {
        return 'accounts';
    }
}
