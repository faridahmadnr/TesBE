<?php

namespace Database\Seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKeys();

        $this->truncateMultiple([
            'users',
            'roles',
            'permissions',
            'model_has_permissions',
            'model_has_roles',
            'role_has_permissions',
        ]);

        $this->enableForeignKeys();
    }
}
