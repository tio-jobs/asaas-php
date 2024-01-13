<?php

namespace TioJobs\AsaasPhp\Concerns;

use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;
use TioJobs\AsaasPhp\Exceptions\ExceptionRequiredApiKey;

trait HasClient
{
    use HasToken;

    /**
     * @throws ExceptionRequiredApiKey
     */
    protected function client(): PendingRequest
    {

        if($this->hasAllowSubAccount() && empty($this->apiKey)) {
            throw new ExceptionRequiredApiKey('You must provide an API key. You can do so by passing it as a parameter to the constructor or methods (e.g., make(apiKey) or withKey(apiKey)).');
        }

        return Http::baseUrl($this->resolveBaseUrl())->withHeader('access_token', $this->apiKey);
    }

    protected function resolveBaseUrl(): string
    {
        return config("asaas-php.environment.{$this->getMode()}.url"); // @phpstan-ignore-line
    }

    protected function hasAllowSubAccount(): bool
    {
        return config('asaas-php.allow_sub_accounts'); // @phpstan-ignore-line
    }

    public function make(string $apiKey = '', string $mode = ''): self
    {
        return new self($apiKey, $mode);
    }

    public function withKey(string $apiKey, string $mode = ''): self
    {
        return $this->make($apiKey, $mode);
    }

    /**
     * @param callable $callback
     * @param AsaasInterface $resource
     * @return array<string, mixed>
     * @throws ExceptionRequiredApiKey
     */
    protected function request(AsaasInterface $resource, callable $callback): array
    {
        try {
            return (array) $callback($resource->getPath(), $resource->getData())
                ->throw()
                ->json();
        } catch (ExceptionRequiredApiKey $apiKeyException) {
            throw $apiKeyException;
        } catch (Exception $exception) {
            return ['error' => $exception->getMessage()];
        }
    }

    /**
     * @return array<string, mixed>
     * @throws ExceptionRequiredApiKey
     */
    public function get(AsaasInterface $resource): array
    {
        return $this->request($resource, fn ($path, $data) => $this->client()->get($path));
    }

    /**
     * @return array<string, mixed>
     * @throws ExceptionRequiredApiKey
     */
    public function post(AsaasInterface $resource): array
    {
        return $this->request($resource, fn ($path, $data) => $this->client()->post($path, $data));
    }

    /**
     * @return array<string, mixed>
     * @throws ExceptionRequiredApiKey
     */
    public function put(AsaasInterface $resource): array
    {
        return $this->request($resource, fn ($path, $data) => $this->client()->put($path, $data));
    }

    /**
     * @return array<string, mixed>
     * @throws ExceptionRequiredApiKey
     */
    public function delete(AsaasInterface $resource): array
    {
        return $this->request($resource, fn ($path, $data) => $this->client()->delete($path));
    }

    /**
     * @return array<string, mixed>
     * @throws ExceptionRequiredApiKey
     */
    public function upload(AsaasInterface $resource): array
    {
        return $this->request($resource, fn ($path, $data) => $this->client()->asMultipart()->post($path, $data));
    }
}
