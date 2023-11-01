<?php

namespace Database\Seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Modules\User\Entities\User;

class UserSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add the master administrator, user id of 1
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => 'secret',
            'email_verified_at' => now(),
        ]);
    }
}
