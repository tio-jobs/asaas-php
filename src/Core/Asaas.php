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

    /**
     * @param AsaasInterface $resource
     * @return mixed
     */
    public function list(AsaasInterface $resource)
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

    /**
     * @param AsaasInterface $resource
     * @return mixed
     */
    public function create(AsaasInterface $resource)
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

    /**
     * @param AsaasInterface $resource
     * @return mixed
     */
    public function get(AsaasInterface $resource)
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

    /**
     * @param AsaasInterface $resource
     * @return mixed
     */
    public function find(AsaasInterface $resource)
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

    /**
     * @param AsaasInterface $resource
     * @return mixed
     */
    public function update(AsaasInterface $resource)
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

    /**
     * @param AsaasInterface $resource
     * @return mixed
     */
    public function delete(AsaasInterface $resource)
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

    /**
     * @param AsaasInterface $resource
     * @return mixed
     */
    public function restore(AsaasInterface $resource)
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

    /**
     * @param AsaasInterface $resource
     * @return mixed
     */
    public function notifications(AsaasInterface $resource)
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

    /**
     * @param AsaasChargeInterface $resource
     * @return mixed
     */
    public function charge(AsaasChargeInterface $resource)
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

    /**
     * @param AsaasInterface $resource
     * @return mixed
     */
    public function upload(AsaasInterface $resource)
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
