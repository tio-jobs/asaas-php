<?php

namespace TioJobs\AsaasPhp\Concerns;

trait HasToken
{
    use HasMode;

    protected function injectApiKey(): void
    {
        $this->apiKey ??= config("asaas-php.environment.{$this->getMode()}.key"); // @phpstan-ignore-line
    }
}
