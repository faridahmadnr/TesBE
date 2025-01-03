<?php

namespace Modules\BusinessType\Database\seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Modules\BusinessType\Entities\BusinessType;

class BusinessTypeDatabaseSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        $this->truncate('business_types');

        $businessTypes = [
            'Akomodasi dan Makan Minum',
            'Industri Pengolahan',
            'IT',
            'Jasa Kesehatan dan Kegiatan Sosial',
            'Jasa Pendidikan',
            'Kelautan dan Perikanan',
            'Konstruksi',
            'Perdagangan Besar dan Eceran',
            'Pertambangan',
            'Pertanian, Perburuan, dan Kehutanan',
            'Real Estate, Usaha Persewaan, dan Jasa Perusahaan',
            'Transportasi, Pergudangan, dan Komunikasi',
        ];

        $businessTypes = collect($businessTypes)
            ->map(function ($businessType) {
                return [
                    'name' => $businessType,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->toArray();

        BusinessType::insert($businessTypes);

        $this->enableForeignKeys();
    }
}
