<?php

namespace TioJobs\AsaasPhp\Concerns;

trait HasData
{
    public function __construct(
        public readonly array $data,
    ) { }
}
