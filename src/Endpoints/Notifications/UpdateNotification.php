<?php

namespace TioJobs\AsaasPhp\Endpoints\Notifications;

use TioJobs\AsaasPhp\Contracts\Core\AsaasInterface;
use TioJobs\AsaasPhp\DataTransferObjects\Notifications\UpdateNotificationDTO;

class UpdateNotification implements AsaasInterface
{
    public function __construct(
        public readonly string $notificationId,
        public readonly UpdateNotificationDTO $updateNotificationDTO,
    ) {
    }

    public function getPath(): string
    {
        return "notifications/{$this->notificationId}";
    }

    /** @return array<string, mixed> */
    public function getData(): array
    {
        return $this->updateNotificationDTO->toArray();
    }
}
