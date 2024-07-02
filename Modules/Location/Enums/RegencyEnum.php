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

    public static function filterParameter($value): self
    {
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
            self::KULONPROGO => _('KABUPATEN KULON PROGO'),
            self::BANTUL => _('KABUPATEN BANTUL'),
            self::GUNUNGKIDUL => _('KABUPATEN GUNUNG KIDUL'),
            self::SLEMAN => _('KABUPATEN SLEMAN'),
            self::YOGYAKARTA => _('KOTA YOGYAKARTA'),
        };
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
