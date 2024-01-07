<?php

namespace TioJobs\AsaasPhp\Endpoints\BankServices;

use TioJobs\AsaasPhp\Concerns\HasBlankData;
use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class GetAllTransfers implements AsaasInterface
{
    use HasMode;
    use HasToken;
    use HasBlankData;

    public function __construct(
        public readonly string $apiKey,
    ) {
    }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.environment.{$this->getMode()}.url");
        assert(is_string($endpoint));
        assert(is_string($endpoint));

        return "{$endpoint}/transfers";
    }
}
