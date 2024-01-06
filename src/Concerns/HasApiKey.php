<?php

namespace TioJobs\AsaasPhp\Concerns;

trait HasApiKey
{
    public function __construct(
        public readonly string $apiKey,
    ) { }
}
