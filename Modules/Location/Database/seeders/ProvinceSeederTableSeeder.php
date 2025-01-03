<?php

namespace Modules\Location\Database\seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class ProvinceSeederTableSeeder extends Seeder
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

        $this->truncate('provinces');

        \DB::table('provinces')->insert([
            0 => [
                'id' => '11',
                'name' => 'ACEH',
            ],
            1 => [
                'id' => '12',
                'name' => 'SUMATERA UTARA',
            ],
            2 => [
                'id' => '13',
                'name' => 'SUMATERA BARAT',
            ],
            3 => [
                'id' => '14',
                'name' => 'RIAU',
            ],
            4 => [
                'id' => '15',
                'name' => 'JAMBI',
            ],
            5 => [
                'id' => '16',
                'name' => 'SUMATERA SELATAN',
            ],
            6 => [
                'id' => '17',
                'name' => 'BENGKULU',
            ],
            7 => [
                'id' => '18',
                'name' => 'LAMPUNG',
            ],
            8 => [
                'id' => '19',
                'name' => 'KEPULAUAN BANGKA BELITUNG',
            ],
            9 => [
                'id' => '21',
                'name' => 'KEPULAUAN RIAU',
            ],
            10 => [
                'id' => '31',
                'name' => 'DKI JAKARTA',
            ],
            11 => [
                'id' => '32',
                'name' => 'JAWA BARAT',
            ],
            12 => [
                'id' => '33',
                'name' => 'JAWA TENGAH',
            ],
            13 => [
                'id' => '34',
                'name' => 'DI YOGYAKARTA',
            ],
            14 => [
                'id' => '35',
                'name' => 'JAWA TIMUR',
            ],
            15 => [
                'id' => '36',
                'name' => 'BANTEN',
            ],
            16 => [
                'id' => '51',
                'name' => 'BALI',
            ],
            17 => [
                'id' => '52',
                'name' => 'NUSA TENGGARA BARAT',
            ],
            18 => [
                'id' => '53',
                'name' => 'NUSA TENGGARA TIMUR',
            ],
            19 => [
                'id' => '61',
                'name' => 'KALIMANTAN BARAT',
            ],
            20 => [
                'id' => '62',
                'name' => 'KALIMANTAN TENGAH',
            ],
            21 => [
                'id' => '63',
                'name' => 'KALIMANTAN SELATAN',
            ],
            22 => [
                'id' => '64',
                'name' => 'KALIMANTAN TIMUR',
            ],
            23 => [
                'id' => '65',
                'name' => 'KALIMANTAN UTARA',
            ],
            24 => [
                'id' => '71',
                'name' => 'SULAWESI UTARA',
            ],
            25 => [
                'id' => '72',
                'name' => 'SULAWESI TENGAH',
            ],
            26 => [
                'id' => '73',
                'name' => 'SULAWESI SELATAN',
            ],
            27 => [
                'id' => '74',
                'name' => 'SULAWESI TENGGARA',
            ],
            28 => [
                'id' => '75',
                'name' => 'GORONTALO',
            ],
            29 => [
                'id' => '76',
                'name' => 'SULAWESI BARAT',
            ],
            30 => [
                'id' => '81',
                'name' => 'MALUKU',
            ],
            31 => [
                'id' => '82',
                'name' => 'MALUKU UTARA',
            ],
            32 => [
                'id' => '91',
                'name' => 'PAPUA BARAT',
            ],
            33 => [
                'id' => '94',
                'name' => 'PAPUA',
            ],
        ]);
        $this->enableForeignKeys();
    }
}
