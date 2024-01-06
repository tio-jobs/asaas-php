<?php

namespace TioJobs\AsaasPhp\Concerns;

use Illuminate\Support\Facades\Http;

trait HasClient
{
    public function __construct(
        protected ?Http $client = null,
    ) {
        if (is_null($this->client)) {
            $this->client = new Http();
        }
    }
}
