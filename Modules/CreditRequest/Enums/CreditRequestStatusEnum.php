<?php

namespace Modules\CreditRequest\Enums;

enum CreditRequestStatusEnum: int
{
    case DRAFT = 1;
    case PENDING = 2;
    case CONFIRMED = 3;
    case APPROVED = 4;
    case REJECTED = 5;
    case PROCESSED = 6;

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => _('Draft'),
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
            case 'draft':
                return self::DRAFT;
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
            case 'diajukan':
                return self::DRAFT;
            case 'diproses':
                return self::PROCESSED;
            case 'ditolak':
                return self::REJECTED;
            case 'dipending':
                return self::PENDING;
            case 'disetujui':
                return self::APPROVED;
            case 'dikonfirmasi':
                return self::CONFIRMED;
            default:
                return self::DRAFT;
        }
    }
}
