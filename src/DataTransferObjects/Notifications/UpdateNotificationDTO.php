<?php

namespace TioJobs\AsaasPhp\DataTransferObjects\Notifications;

use TioJobs\AsaasPhp\Contracts\Core\ArrayableInterface;
use TioJobs\AsaasPhp\Enums\ScheduleOffsetEnum;

class UpdateNotificationDTO implements ArrayableInterface
{
    public function __construct(
        public readonly ?string $notificationId = null,
        public readonly bool $enabled = true,
        public readonly bool $emailEnabledForProvider = false,
        public readonly bool $smsEnabledForProvider = false,
        public readonly bool $emailEnabledForCustomer = true,
        public readonly bool $smsEnabledForCustomer = true,
        public readonly bool $phoneCallEnabledForCustomer = false,
        public readonly bool $whatsappEnabledForCustomer = true,
        public readonly ?ScheduleOffsetEnum $scheduleOffset = null,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->notificationId,
            'enabled' => $this->enabled,
            'emailEnabledForProvider' => $this->emailEnabledForProvider,
            'smsEnabledForProvider' => $this->smsEnabledForProvider,
            'emailEnabledForCustomer' => $this->emailEnabledForCustomer,
            'smsEnabledForCustomer' => $this->smsEnabledForCustomer,
            'phoneCallEnabledForCustomer' => $this->phoneCallEnabledForCustomer,
            'whatsappEnabledForCustomer' => $this->whatsappEnabledForCustomer,
            'scheduleOffset' => $this->scheduleOffset?->value,
        ];
    }
}
