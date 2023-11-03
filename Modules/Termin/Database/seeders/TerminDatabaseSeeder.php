<?php

namespace Modules\Termin\Database\seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Modules\Termin\Entities\Termin;

class TerminDatabaseSeeder extends Seeder
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

        $this->truncate('termins');

        Termin::insert([
            [
                'name' => '1 TAHUN',
                'value' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '2 TAHUN',
                'value' => 24,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '3 TAHUN',
                'value' => 36,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '4 TAHUN',
                'value' => 48,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '5 TAHUN',
                'value' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '6 TAHUN',
                'value' => 72,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->enableForeignKeys();
    }
}
