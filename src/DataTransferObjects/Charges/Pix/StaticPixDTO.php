<?php

namespace TioJobs\AsaasPhp\DataTransferObjects\Charges\Pix;

use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Enums\BillingTypeEnum;

class StaticPixDTO
{
    use HasMode;
    public readonly mixed $pixKey;
    public function __construct(
        public readonly string $description,
        public readonly float $value,
        public string $expirationDateTime = '',
        public string $format = 'ALL',
        public ?string $expirationSeconds = null,
    ) {
        $this->pixKey = config("asaas-php.mode.{$this->getMode()}.pix_key");

        if (blank($this->expirationDateTime)) {
            $this->expirationDateTime = \Carbon\Carbon::now()->addYears(5)->format('Y-m-d H:i:s');
        }
    }
}
