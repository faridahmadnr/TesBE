<?php

namespace Modules\Location\Enums;

enum RegencyEnum: int
{
    case KULONPROGO = 3401;
    case BANTUL = 3402;
    case GUNUNGKIDUL = 3403;
    case SLEMAN = 3404;
    case YOGYAKARTA = 3471;

    public static function validRegencies()
    {
        return [
            'KABUPATEN KULON PROGO',
            'KABUPATEN BANTUL',
            'KABUPATEN GUNUNG KIDUL',
            'KABUPATEN SLEMAN',
            'KOTA YOGYAKARTA',
        ];
    }

    public static function getIndexMapGeojson($value): mixed
    {
        switch ($value) {
            case 'KABUPATEN GUNUNG KIDUL':
                return '0';
            case 'KABUPATEN SLEMAN':
                return '1';
            case 'KABUPATEN BANTUL':
                return '2';
            case 'KABUPATEN KULON PROGO':
                return '3';
            case 'KOTA YOGYAKARTA':
                return '4';

            default:
                return null;
        }
    }

    public static function filterParameter($value)
    {
        // @phpstan-ignore-next-line
        return match ($value) {
            'Kab-Kulon-Progo' => self::KULONPROGO,
            'Kab-Bantul' => self::BANTUL,
            'Kab-Gunung-Kidul' => self::GUNUNGKIDUL,
            'Kab-Sleman' => self::SLEMAN,
            'Kota-Yogyakarta' => self::YOGYAKARTA
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::KULONPROGO => __('KABUPATEN KULON PROGO'),
            self::BANTUL => __('KABUPATEN BANTUL'),
            self::GUNUNGKIDUL => __('KABUPATEN GUNUNG KIDUL'),
            self::SLEMAN => __('KABUPATEN SLEMAN'),
            self::YOGYAKARTA => __('KOTA YOGYAKARTA'),
        };
    }

    public static function fromProvinceId($value): mixed
    {
        switch ($value) {
            case self::KULONPROGO->value:
                return __('KABUPATEN KULON PROGO');
            case self::BANTUL->value:
                return __('KABUPATEN BANTUL');
            case self::GUNUNGKIDUL->value:
                return __('KABUPATEN GUNUNG KIDUL');
            case self::SLEMAN->value:
                return __('KABUPATEN SLEMAN');
            case self::YOGYAKARTA->value:
                return __('KOTA YOGYAKARTA');
            default:
                return null;
        }
    }

    public static function fromValue($value): mixed
    {
        switch ($value) {
            case 'KABUPATEN KULON PROGO':
                return self::KULONPROGO;
            case 'KABUPATEN BANTUL':
                return self::BANTUL;
            case 'KABUPATEN GUNUNG KIDUL':
                return self::GUNUNGKIDUL;
            case 'KABUPATEN SLEMAN':
                return self::SLEMAN;
            case 'KOTA YOGYAKARTA':
                return self::YOGYAKARTA;
            default:
                return null;
        }
    }
}
