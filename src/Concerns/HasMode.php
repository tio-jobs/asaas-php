<?php

namespace TioJobs\AsaasPhp\Concerns;

trait HasMode
{
    public function getMode(): string
    {

        if (!empty($this->mode)) {
            return $this->mode;
        }

        /** @phpstan-ignore-next-line  */
        return app()->isLocal() ? 'sandbox' : 'production';
    }
}
