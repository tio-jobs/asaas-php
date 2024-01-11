<?php

namespace TioJobs\AsaasPhp\Contracts\Core;

interface ArrayableInterface
{
    /**
     * Get the instance as an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array;
}
