<?php

namespace TioJobs\AsaasPhp\Contracts\Core;

interface AsaasInterface
{
    public function getMode(): string;
    public function getPath(): string;
    public function getData(): array;

    public function getToken(): ?string;
}
