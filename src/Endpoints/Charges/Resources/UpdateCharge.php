<?php

namespace TioJobs\AsaasPhp\Endpoints\Charges\Resources;

use TioJobs\AsaasPhp\Concerns\HasIdAndData;
use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class UpdateCharge implements AsaasInterface
{
    use HasToken;
    use HasMode;

    public function __construct(
        public readonly string $apiKey,
        public readonly string $id,
        public readonly array $data,
    ) {
    }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.environment.{$this->getMode()}.url");
        assert(is_string($endpoint));

        return "{$endpoint}/payments/{$this->id}";
    }

    /** @return array<string,string> */
    public function getData(): array
    {
        return $this->data;
    }
}
