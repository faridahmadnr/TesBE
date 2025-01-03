<?php

namespace Modules\User\Database\seeders;

use App\Enums\RolesEnum;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Modules\User\Entities\User;

class UserDatabaseSeeder extends Seeder
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

        $this->call(RolesAndPermissionsSeeder::class);

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => 'secret1234',
            'email_verified_at' => now(),
        ]);
        $user->syncRoles([RolesEnum::SUPER_ADMIN]);

        $this->enableForeignKeys();
    }
}
