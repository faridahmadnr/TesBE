<?php

namespace Modules\DataVisualization\Database\seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class DataVisualizationDatabaseSeeder extends Seeder
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

        // $this->truncate('model_name');

        // $this->call("OthersTableSeeder");
        $this->enableForeignKeys();
    }
}
