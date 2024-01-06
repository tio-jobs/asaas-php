<?php

namespace TioJobs\AsaasPhp\Concerns;

trait HasToken
{
    use HasMode;
    protected string $token = '';

    public function getToken(): ?string
    {
        return config("asaas-php.mode.{$this->getMode()}.key");
    }
}
