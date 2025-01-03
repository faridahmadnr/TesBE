<?php

namespace Modules\Report\Enums;

enum QuartersEnum: string
{
    case Q1 = 'Q1';
    case Q2 = 'Q2';
    case Q3 = 'Q3';
    case Q4 = 'Q4';

    public static function getQuarterMonthsValue($quarter)
    {
        if (! $quarter) {
            return [null, null];
        }
        $selectedQuarter = self::fromValue($quarter);

        return [$selectedQuarter->startMonth(), $selectedQuarter->endMonth()];
    }

    public function label(): string
    {
        return match ($this) {
            self::Q1 => _('Quarter 1 (January - March)'),
            self::Q2 => _('Quarter 2 (April - June)'),
            self::Q3 => _('Quarter 3 (July - September)'),
            self::Q4 => _('Quarter 4 (October - December)'),
        };
    }

    public static function fromValue($value)
    {
        // @phpstan-ignore-next-line
        return match ($value) {
            'Q1' => self::Q1,
            'Q2' => self::Q2,
            'Q3' => self::Q3,
            'Q4' => self::Q4,
        };
    }

    protected function startMonth(): int
    {
        return match ($this) {
            self::Q1 => 1, // January
            self::Q2 => 4, // April
            self::Q3 => 7, // July
            self::Q4 => 10, // October
        };
    }

    protected function endMonth(): int
    {
        return match ($this) {
            self::Q1 => 3, // March
            self::Q2 => 6, // June
            self::Q3 => 9, // September
            self::Q4 => 12, // December
        };
    }
}
