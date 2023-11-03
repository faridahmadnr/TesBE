<?php

namespace Modules\CreditRequest\Enums;

enum CreditRequestStatusEnum: int
{
    case PENDING = 1;
    case CONFIRMED = 2;
    case APPROVED = 3;
    case REJECTED = 4;

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::APPROVED => 'Approved',
            self::REJECTED => 'Rejected',
            self::CONFIRMED => 'Confirmed',
        };
    }
}
