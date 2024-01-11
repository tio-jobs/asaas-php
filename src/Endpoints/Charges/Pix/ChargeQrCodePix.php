<?php

namespace TioJobs\AsaasPhp\Endpoints\Charges\Pix;

use TioJobs\AsaasPhp\Concerns\HasBlankData;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;

class ChargeQrCodePix implements AsaasInterface
{
    use HasBlankData;

    public function __construct(
        public readonly string $id,
    ) {
    }

    public function getPath(): string
    {
        return "payments/{$this->id}/pixQrCode";
    }
}
