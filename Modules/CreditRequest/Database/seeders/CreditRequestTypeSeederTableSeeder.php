<?php

namespace Modules\CreditRequest\Database\seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Modules\CreditRequest\Entities\CreditRequestType;

class CreditRequestTypeSeederTableSeeder extends Seeder
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

        $this->truncate('credit_request_types');

        CreditRequestType::insert([
            [
                'name' => 'Kur Kecil',
                'min_value' => '100000001',
                'max_value' => '500000000',
                'interest' => '0.06',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kur Mikro',
                'min_value' => '10000001',
                'max_value' => '100000000',
                'interest' => '0.06',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kur Super Mikro',
                'min_value' => '1000000',
                'max_value' => '10000000',
                'interest' => '0.03',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->enableForeignKeys();
    }
}
