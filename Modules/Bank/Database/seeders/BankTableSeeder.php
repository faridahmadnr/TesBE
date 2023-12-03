<?php

namespace Modules\Bank\Database\seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Modules\Bank\Entities\Bank;

class BankTableSeeder extends Seeder
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

        $this->truncate('banks');

        Bank::insert([
            [
                'code' => '014',
                'link' => 'https://www.bca.co.id/',
                // 'logo' => 'https://kur.jogjaprov.go.id/storage/bank/f80e4cb132827c6561476f89e53a5227_1679899801_300px.png',
                'name' => 'Bank BCA',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => '113',
                'link' => 'https://www.bankjateng.co.id/',
                // 'logo' => 'http://phplaravel-151716-2282619.cloudwaysapps.com/storage/bank/5c7b88493d3348f9ffdf22b70470d9b1_1640064548_300px.jpg',
                'name' => 'Bank Jateng',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => '441',
                'link' => 'https://www.bukopin.co.id/',
                // 'logo' => 'http://phplaravel-151716-2282619.cloudwaysapps.com/storage/bank/26ef574243a96fa382b508317c6e2943_1640064572_300px.jpg',
                'name' => 'Bank KB Bukopin',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => '008',
                'link' => 'https://bankmandiri.co.id/',
                // 'logo' => 'http://phplaravel-151716-2282619.cloudwaysapps.com/storage/bank/9d52c3594041fb578fe1dc3cbb23ed8a_1640064638_300px.jpg',
                'name' => 'Bank Mandiri',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => '153',
                'link' => 'https://www.banksinarmas.com',
                // 'logo' => 'http://phplaravel-151716-2282619.cloudwaysapps.com/storage/bank/f773faee155b742b567ca5e5cdf02de2_1640064629_300px.jpg',
                'name' => 'Bank Sinarmas',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => '',
                'link' => 'https://www.bankbsi.co.id/',
                // 'logo' => 'http://phplaravel-151716-2282619.cloudwaysapps.com/storage/bank/0b4d899510a6738a76310f82406a47a4_1640064650_300px.jpg',
                'name' => 'Bank Syariah Indonesia',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'BNI',
                'link' => 'https://www.bni.co.id/id-id/',
                // 'logo' => 'https://phplaravel-151716-2282619.cloudwaysapps.com/storage/bank/79de313dff33f25833f420b386e9cf10_1637729413_300px.png',
                'name' => 'BNI',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => '112',
                'link' => 'https://www.bpddiy.co.id/',
                // 'logo' => 'http://phplaravel-151716-2282619.cloudwaysapps.com/storage/bank/9017619bbcd3e45c980c0f6f59937fe1_1640064619_300px.jpg',
                'name' => 'BPD DIY',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => '002',
                'link' => 'https://bri.co.id/',
                // 'logo' => 'http://phplaravel-151716-2282619.cloudwaysapps.com/storage/bank/42795160811ddb9c6d624797b6162ba2_1640064592_300px.jpg',
                'name' => 'BRI',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => '200',
                'link' => 'https://www.btn.co.id/',
                // 'logo' => 'http://phplaravel-151716-2282619.cloudwaysapps.com/storage/bank/b7cd6a2f6350fe5557bbc7ea84a3d37d_1640064391_300px.jpg',
                'name' => 'BTN',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => '132',
                'link' => 'https://www.bankpapua.co.id/',
                // 'logo' => 'http://phplaravel-151716-2282619.cloudwaysapps.com/storage/bank/c538b72fd435cdf758468bf3335c8e8c_1640064470_300px.jpg',
                'name' => 'PT BPD Papua',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // $this->call("OthersTableSeeder");
        $this->enableForeignKeys();
    }
}
