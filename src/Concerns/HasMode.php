<?php

namespace TioJobs\AsaasPhp\Concerns;

trait HasMode
{
    protected string $mode = '';

    public function getMode(): string
    {
        return app()->isLocal() ? 'sandbox' : 'production';
    }
}
