<?php

namespace TioJobs\AsaasPhp\Endpoints\Charges\Resources;

use TioJobs\AsaasPhp\Concerns\HasBlankData;
use TioJobs\AsaasPhp\Concerns\HasPagination;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class ListAllCharges implements AsaasInterface
{
    use HasBlankData;
    use HasPagination;

    public function getPath(): string
    {
        return "payments?limit={$this->limit}&offset={$this->offset}";
    }
}
