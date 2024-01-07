<?php

namespace TioJobs\AsaasPhp\Concerns;

trait HasMode
{
    protected string $mode = '';

    public function getMode(): string
    {
        /** @phpstan-ignore-next-line  */
        return app()->isLocal() ? 'sandbox' : 'production';
    }
}
