<?php

namespace TioJobs\AsaasPhp\Concerns;

trait HasIdAndData
{
    public function __construct(
        public readonly string $id,
        public readonly array $data,
    ) {
    }
}
