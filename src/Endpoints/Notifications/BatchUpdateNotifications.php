<?php

namespace TioJobs\AsaasPhp\Endpoints\Notifications;

use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;
use TioJobs\AsaasPhp\DataTransferObjects\Notifications\UpdateNotificationDTO;

class BatchUpdateNotifications implements AsaasInterface
{
    public function __construct(
        public readonly string $customerId,
        public array|UpdateNotificationDTO $updateNotificationDTO
    ) {
    }

    public function getPath(): string
    {
        return 'notifications/batch';
    }

    /** @return array<string, mixed> */
    protected function getNotifications(): array
    {
        $notifications = $this->updateNotificationDTO;

        if (! is_array($notifications)) {
            $notifications = [$notifications];
        }

        foreach ($notifications as $notification) {
            if (! $notification instanceof UpdateNotificationDTO) {
                throw new \InvalidArgumentException('Invalid notification provided.');
            }

            $notifications[] = $notification->toArray();
        }

        return $notifications;

    }

    /** @return array<string, mixed> */
    public function getData(): array
    {
        return [
            'customer' => $this->customerId,
            'notifications' => $this->getNotifications(),
        ];
    }
}
