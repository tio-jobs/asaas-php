<?php

namespace TioJobs\AsaasPhp\Contracts\Core;

interface AsaasInterface
{
    public function getPath(): string;

    public function getData(): array;
}
