<?php

namespace TioJobs\AsaasPhp\Endpoints\Notifications;

use TioJobs\AsaasPhp\Concerns\HasIdAndData;
use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;
use TioJobs\AsaasPhp\DataTransferObjects\Notifications\UpdateNotificationDTO;

class UpdateNotification implements AsaasInterface
{
    use HasMode;
    use HasToken;

    public function __construct(
        public readonly string $apiKey,
        public readonly string $notificationId,
        public readonly UpdateNotificationDTO $updateNotificationDTO,
    ) {
    }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.environment.{$this->getMode()}.url");
        assert(is_string($endpoint));

        return "{$endpoint}/notifications/{$this->notificationId}";
    }

    /** @return array<string, bool|string> */
    public function getData(): array
    {
        $data = [
            'enabled' => $this->updateNotificationDTO->enabled,
            'emailEnabledForProvider' => $this->updateNotificationDTO->emailEnabledForProvider,
            'smsEnabledForProvider' => $this->updateNotificationDTO->smsEnabledForProvider,
            'emailEnabledForCustomer' => $this->updateNotificationDTO->emailEnabledForCustomer,
            'smsEnabledForCustomer' => $this->updateNotificationDTO->smsEnabledForCustomer,
            'phoneCallEnabledForCustomer' => $this->updateNotificationDTO->phoneCallEnabledForCustomer,
            'whatsappEnabledForCustomer' => $this->updateNotificationDTO->whatsappEnabledForCustomer,
        ];

        if (!is_null($this->updateNotificationDTO->scheduleOffset?->value)) {
            $merge = [
                'scheduleOffset' => $this->updateNotificationDTO->scheduleOffset->value,
            ];

            $data = array_merge($data, $merge);
        }

        return $data;
    }
}
