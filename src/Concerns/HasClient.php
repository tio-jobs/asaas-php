<?php

namespace TioJobs\AsaasPhp\Concerns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

trait HasClient
{
    use HasToken;

    protected function client(): PendingRequest
    {
        return Http::baseUrl($this->resolveBaseUrl())->withHeader('access_token', $this->apiKey);
    }

    protected function resolveBaseUrl(): string
    {
        return config("asaas-php.environment.{$this->getMode()}.url"); // @phpstan-ignore-line
    }

    public static function make(string $apiKey): self
    {
        return new self($apiKey);
    }

    /**
     * @return array<string, mixed>
     */
    public function get(AsaasInterface $resource): array
    {
        try {
            return (array) $this->client()
                ->get($resource->getPath())
                ->throw()
                ->json();
        } catch (\Exception $exception) {
            return ['error' => $exception->getMessage()];
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function post(AsaasInterface $resource): array
    {
        try {
            return (array) $this->client()
                ->post($resource->getPath(), $resource->getData())
                ->throw()
                ->json();
        } catch (\Exception $exception) {
            return ['error' => $exception->getMessage()];
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function put(AsaasInterface $resource): array
    {
        try {
            return (array) $this->client()
                ->put($resource->getPath(), $resource->getData())
                ->throw()
                ->json();
        } catch (\Exception $exception) {
            return ['error' => $exception->getMessage()];
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function delete(AsaasInterface $resource): array
    {
        try {
            return (array) $this->client()
                ->delete($resource->getPath())
                ->throw()
                ->json();
        } catch (\Exception $exception) {
            return ['error' => $exception->getMessage()];
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function upload(AsaasInterface $resource): array
    {
        try {
            return (array) $this->client()
                ->asMultipart()
                ->post($resource->getPath(), $resource->getData())
                ->throw()
                ->json();
        } catch (\Exception $exception) {
            return ['error' => $exception->getMessage()];
        }
    }
}
