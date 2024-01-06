<?php

namespace TioJobs\AsaasPhp\Concerns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

trait HasClient
{
    public function __construct(
        protected ?Http $client = null,
    ) {
    }

    public function getClient(string $accessToken): PendingRequest
    {
        return Http::withHeader('access_token', $accessToken);
    }
}
