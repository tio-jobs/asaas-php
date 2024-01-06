<?php

namespace TioJobs\AsaasPhp\Core;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use TioJobs\AsaasPhp\Concerns\HasClient;
use TioJobs\AsaasPhp\Concerns\HasToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasChargeInterface;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class Asaas
{
    use HasClient;
    use HasToken;

    public function list(AsaasInterface $resource): array|null
    {
        try {
            return $this->getClient($resource->getToken())
                ->get($resource->getPath())
                ->throw()
                ->json();
        } catch (\Exception $exception) {
            return ['error' => $exception->getMessage()];
        }
    }

    public function create(AsaasInterface $resource): array|null
    {
        try {
            return $this->getClient($resource->getToken())
                ->post($resource->getPath(), $resource->getData())
                ->throw()
                ->json();
        } catch (\Exception $exception) {
            return ['error' => $exception->getMessage()];
        }
    }

    public function get(AsaasInterface $resource): array|null
    {
        try {
            return $this->getClient($resource->getToken())
                ->get($resource->getPath())
                ->throw()
                ->json();
        } catch (\Exception $exception) {
            return ['error' => $exception->getMessage()];
        }
    }

    public function find(AsaasInterface $resource): array|null
    {
        try {
            return $this->getClient($resource->getToken())
                ->get($resource->getPath())
                ->throw()
                ->json();
        } catch (\Exception $exception) {
            return ['error' => $exception->getMessage()];
        }
    }

    public function update(AsaasInterface $resource): array|null
    {
        try {
            return $this->getClient($resource->getToken())
                ->put($resource->getPath(), $resource->getData())
                ->throw()
                ->json();
        } catch (\Exception $exception) {
            return ['error' => $exception->getMessage()];
        }
    }

    public function delete(AsaasInterface $resource): array|null
    {
        try {
            return $this->getClient($resource->getToken())
                ->delete($resource->getPath())
                ->throw()
                ->json();
        } catch (\Exception $exception) {
            return ['error' => $exception->getMessage()];
        }
    }

    public function restore(AsaasInterface $resource): array|null
    {
        try {
            return $this->getClient($resource->getToken())
                ->post($resource->getPath())
                ->throw()
                ->json();
        } catch (\Exception $exception) {
            return ['error' => $exception->getMessage()];
        }
    }

    public function notifications(AsaasInterface $resource): array|null
    {
        try {
            return $this->getClient($resource->getToken())
                ->get($resource->getPath())
                ->throw()
                ->json();
        } catch (\Exception $exception) {
            return ['error' => $exception->getMessage()];
        }
    }

    public function charge(AsaasChargeInterface $resource): array|null
    {
        try {
            return $this->getClient($resource->getToken())
                ->post($resource->getPath(), $resource->getData())
                ->throw()
                ->json();
        } catch (\Exception $exception) {
            return ['error' => $exception->getMessage()];
        }
    }

    public function upload(AsaasInterface $resource): array|null
    {
        try {
            return $this->getClient($resource->getToken())
                ->asMultipart()
                ->post($resource->getPath(), $resource->getData())
                ->throw()
                ->json();
        } catch (\Exception $exception) {
            return ['error' => $exception->getMessage()];
        }
    }
}
