<?php

namespace TioJobs\AsaasPhp\Endpoints\Notifications;

use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasNullableToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;
use TioJobs\AsaasPhp\DataTransferObjects\Notifications\UpdateNotificationDTO;

class BatchUpdateNotifications implements AsaasInterface
{
    use HasMode;
    use HasNullableToken;

    protected array $notifications = [];

    public function __construct(
        public readonly string $apiKey,
        public readonly string $customerId,
    ) { }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.mode.{$this->getMode()}.url");

        return "{$endpoint}/notifications/batch";
    }

    public function addNotification(UpdateNotificationDTO $updateNotificationDTO): void
    {
        $this->notifications[] = [
            'id' => $updateNotificationDTO->notificationId,
            'enabled' => $updateNotificationDTO->enabled,
            'emailEnabledForProvider' => $updateNotificationDTO->emailEnabledForProvider,
            'smsEnabledForProvider' => $updateNotificationDTO->smsEnabledForProvider,
            'emailEnabledForCustomer' => $updateNotificationDTO->emailEnabledForCustomer,
            'smsEnabledForCustomer' => $updateNotificationDTO->smsEnabledForCustomer,
            'phoneCallEnabledForCustomer' => $updateNotificationDTO->phoneCallEnabledForCustomer,
            'whatsappEnabledForCustomer' => $updateNotificationDTO->whatsappEnabledForCustomer,
        ];
    }

    public function getData(): array
    {
        return [
            'customer' => $this->customerId,
            'notifications' => $this->notifications,
        ];
    }
}
