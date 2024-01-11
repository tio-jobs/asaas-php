<?php

namespace TioJobs\AsaasPhp\Endpoints\Charges\Resources;

use TioJobs\AsaasPhp\Concerns\HasIdAndData;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class UpdateCharge implements AsaasInterface
{
    use HasIdAndData;

    public function getPath(): string
    {
        return "payments/{$this->id}";
    }

    /** @return array<string,string> */
    public function getData(): array
    {
        return $this->data;
    }
}
