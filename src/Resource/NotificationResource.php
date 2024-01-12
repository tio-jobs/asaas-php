<?php

namespace TioJobs\AsaasPhp\Resource;

use TioJobs\AsaasPhp\DataTransferObjects\Notifications\UpdateNotificationDTO;
use TioJobs\AsaasPhp\Endpoints\Notifications\BatchUpdateNotifications;
use TioJobs\AsaasPhp\Endpoints\Notifications\UpdateNotification;

class NotificationResource extends Resource
{
    /**
     * @param  array<UpdateNotificationDTO>|UpdateNotificationDTO  $DTO
     * @return array<string, mixed>
     */
    public function batchUpdate(string $customerId, array|UpdateNotificationDTO $DTO): array
    {
        return $this->asaas->put(new BatchUpdateNotifications($customerId, $DTO));
    }

    /**
     * @return array<string, mixed>
     */
    public function update(string $notificationId, UpdateNotificationDTO $DTO): array
    {
        return $this->asaas->put(new UpdateNotification($notificationId, $DTO));
    }
}
