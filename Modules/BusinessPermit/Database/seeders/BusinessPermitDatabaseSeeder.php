<?php

namespace Modules\BusinessPermit\Database\seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Modules\BusinessPermit\Entities\BusinessPermit;

class BusinessPermitDatabaseSeeder extends Seeder
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

        $this->truncate('business_permits');

        BusinessPermit::insert([
            [
                'name' => 'Ijin UMK dari Kecamatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Surat Keterangan Usaha dari Desa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Surat Wasiat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lainnya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->enableForeignKeys();
    }
}
