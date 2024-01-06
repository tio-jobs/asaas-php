<?php



namespace TioJobs\AsaasPhp\Contracts\Notifications;

interface NotificationInterface
{
    public function get(string $resourceId): array;
}
