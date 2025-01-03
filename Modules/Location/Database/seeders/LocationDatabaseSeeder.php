<?php

namespace Modules\Location\Database\seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class LocationDatabaseSeeder extends Seeder
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
        $this->call(ProvinceSeederTableSeeder::class);
        $this->call(RegencySeederTableSeeder::class);
        $this->call(DistrictSeederTableSeeder::class);
        $this->enableForeignKeys();
    }
}
