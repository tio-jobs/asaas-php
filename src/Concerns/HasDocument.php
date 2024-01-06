<?php

namespace TioJobs\AsaasPhp\Concerns;

trait HasDocument
{
    public function __construct(
        public readonly string $document,
    ) { }
}
