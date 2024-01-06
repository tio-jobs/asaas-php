<?php

namespace TioJobs\AsaasPhp\DataTransferObjects\SubAccounts;

use TioJobs\AsaasPhp\Concerns\HasMode;

class SubAccountWebhooksDTO
{
    use HasMode;

    public function __construct(
        public string        $url = '',
        public string        $email = '',
        public ?int          $apiVersion = null,
        public readonly bool $enabled = true,
        public readonly bool $interrupted = true,
        public ?string       $authToken = null,

    )
    {
        if (blank($this->url)) {
            $this->url = config("asaas-php.mode.{$this->getMode()}.webhook_url");
        }

        if (blank($this->email)) {
            $this->email = config("asaas-php.mode.{$this->getMode()}.email");
        }

        if (blank($this->apiVersion)) {
            $this->apiVersion = (int)str(config('asaas-php.version'))->replace('v', '')->toString();
        }

        if (blank($this->authToken)) {
            $this->authToken = config("asaas-php.mode.{$this->getMode()}.webhook_token");
        }
    }
}
