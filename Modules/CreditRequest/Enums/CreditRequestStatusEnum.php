<?php

namespace Modules\CreditRequest\Enums;

enum CreditRequestStatusEnum: int
{
    case PENDING = 1;
    case CONFIRMED = 2;
    case APPROVED = 3;
    case REJECTED = 4;
    case PROCESSED = 5;

    public function label(): string
    {
        return match ($this) {
            self::PENDING => _('Pending'),
            self::APPROVED => _('Approved'),
            self::REJECTED => _('Rejected'),
            self::CONFIRMED => _('Confirmed'),
            self::PROCESSED => _('Processed'),
        };
    }

    public static function fromValue($value)
    {
        switch ($value) {
            case 'pending':
                return self::PENDING;
            case 'confirmed':
                return self::CONFIRMED;
            case 'approved':
                return self::APPROVED;
            case 'rejected':
                return self::REJECTED;
            case 'processed':
                return self::REJECTED;
            default:
                return self::PENDING;
        }
    }
}
