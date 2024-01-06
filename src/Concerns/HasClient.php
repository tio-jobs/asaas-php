<?php

namespace TioJobs\AsaasPhp\Concerns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

trait HasClient
{
    public function getClient(string|null $accessToken): PendingRequest
    {
        return Http::withHeader('access_token', $accessToken);
    }
}
