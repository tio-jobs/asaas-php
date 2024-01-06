<?php

namespace TioJobs\AsaasPhp\Concerns;

trait HasIdAndDocument
{
    public function __construct(
        public readonly string $id,
        public readonly string $document,
    ) { }
}
