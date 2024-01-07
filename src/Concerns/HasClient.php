<?php

namespace TioJobs\AsaasPhp\Concerns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

trait HasClient
{
    /**
     * @param mixed $accessToken
     * @return PendingRequest
     */
    public function getClient(mixed $accessToken): PendingRequest
    {
        return Http::withHeader('access_token', $accessToken);
    }
}
