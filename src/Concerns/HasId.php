<?php

namespace TioJobs\AsaasPhp\Concerns;

trait HasId
{
    public function __construct(
        public readonly string $id,
    ) { }
}
