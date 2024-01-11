<?php

namespace TioJobs\AsaasPhp\Endpoints\Charges\Pix;

use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;
use TioJobs\AsaasPhp\DataTransferObjects\Charges\Pix\StaticPixDTO;

class ChargeByStaticPix implements AsaasInterface
{
    public function __construct(
        protected StaticPixDTO $staticPixDTO,
    ) {
    }

    public function getPath(): string
    {
        return 'pix/qrCodes/static';
    }

    /** @return array<string,mixed> */
    public function getData(): array
    {
        return [
            'addressKey' => $this->staticPixDTO->pixKey,
            'description' => $this->staticPixDTO->description,
            'value' => $this->staticPixDTO->value,
            'format' => $this->staticPixDTO->format,
            'expirationDate' => $this->staticPixDTO->expirationDateTime,
            'expirationSeconds' => $this->staticPixDTO->expirationSeconds,
        ];
    }
}
