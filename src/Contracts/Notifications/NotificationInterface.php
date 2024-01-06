<?php

namespace TioJobs\AsaasPhp\Contracts\Notifications;

interface NotificationInterface
{
    /** @return array<string,string> */
    public function get(string $resourceId): array;
}
