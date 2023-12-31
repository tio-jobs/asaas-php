<?php

namespace TioJobs\AsaasPhp\Endpoints\Charges\Pix;

use Illuminate\Support\Facades\Http;
use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasChargeInterface;
use TioJobs\AsaasPhp\DataTransferObjects\Charges\Pix\DynamicPixDTO;
use TioJobs\AsaasPhp\DataTransferObjects\Charges\Pix\StaticPixDTO;

class ChargeByStaticPix implements AsaasChargeInterface
{
    use HasMode;
    use HasToken;

    public function __construct(
        protected StaticPixDTO $staticPixDTO,
    ) {
    }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.environment.{$this->getMode()}.url");
        assert(is_string($endpoint));

        return "{$endpoint}/pix/qrCodes/static";
    }

    /** @return array<string,mixed> */
    public function getData(): array
    {
        return [
            "addressKey" => $this->staticPixDTO->pixKey,
            "description" => $this->staticPixDTO->description,
            "value" => $this->staticPixDTO->value,
            "format" => $this->staticPixDTO->format,
            "expirationDate" => $this->staticPixDTO->expirationDateTime,
            "expirationSeconds" => $this->staticPixDTO->expirationSeconds,
        ];
    }
}
