<?php

namespace TioJobs\AsaasPhp\Concerns;

trait HasNullableToken
{
    public function getToken(): ?string
    {
        return $this->apiKey;
    }
}
