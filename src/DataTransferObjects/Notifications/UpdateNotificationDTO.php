<?php

namespace TioJobs\AsaasPhp\DataTransferObjects\Notifications;

use TioJobs\AsaasPhp\Contracts\Core\ArrayableInterface;
use TioJobs\AsaasPhp\Enums\ScheduleOffsetEnum;

readonly class UpdateNotificationDTO implements ArrayableInterface
{
    public function __construct(
        public ?string $notificationId = null,
        public bool $enabled = true,
        public bool $emailEnabledForProvider = false,
        public bool $smsEnabledForProvider = false,
        public bool $emailEnabledForCustomer = true,
        public bool $smsEnabledForCustomer = true,
        public bool $phoneCallEnabledForCustomer = false,
        public bool $whatsappEnabledForCustomer = true,
        public ?ScheduleOffsetEnum $scheduleOffset = null,
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
