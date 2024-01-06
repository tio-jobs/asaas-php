<?php

namespace TioJobs\AsaasPhp\Endpoints\BankServices;

use Carbon\Carbon;
use TioJobs\AsaasPhp\Concerns\HasBlankData;
use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasNullableToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class GetBankStatement implements AsaasInterface
{
    use HasMode;
    use HasBlankData;
    use HasNullableToken;

    public function __construct(
        protected string $apiKey,
        protected ?string $startDate = null,
        protected ?string $endDate = null,
        protected int $offset = 0,
        protected int $limit = 10,
    ) {
        if (is_null($this->startDate)) {
            $this->startDate = Carbon::now()->subMonths(3)->format('Y-m-d');
        }

        if (is_null($this->endDate)) {
            $this->startDate = Carbon::now()->format('Y-m-d');
        }
    }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.mode.{$this->getMode()}.url");
        assert(is_string($endpoint));
        assert(is_string($endpoint));

        return "{$endpoint}/financialTransactions?startDate={$this->startDate}&finishDate={$this->endDate}&offset={$this->offset}&limit={$this->limit}";
    }
}
