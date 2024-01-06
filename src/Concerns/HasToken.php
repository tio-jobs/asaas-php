<?php

namespace TioJobs\AsaasPhp\Concerns;

trait HasToken
{
    use HasMode;

    public function getToken(): mixed
    {
        return config("asaas-php.mode.{$this->getMode()}.key");
    }
}
