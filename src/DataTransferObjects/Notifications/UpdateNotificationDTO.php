<?php

namespace TioJobs\AsaasPhp\DataTransferObjects\Notifications;

use TioJobs\AsaasPhp\Enums\ScheduleOffsetEnum;

readonly class UpdateNotificationDTO
{
    public function __construct(
        public ?string             $notificationId = null,
        public bool                $enabled = true,
        public bool                $emailEnabledForProvider = false,
        public bool                $smsEnabledForProvider = false,
        public bool                $emailEnabledForCustomer = true,
        public bool                $smsEnabledForCustomer = true,
        public bool                $phoneCallEnabledForCustomer = false,
        public bool                $whatsappEnabledForCustomer = true,
        public ?ScheduleOffsetEnum $scheduleOffset = null,
    )
    {
    }
}
