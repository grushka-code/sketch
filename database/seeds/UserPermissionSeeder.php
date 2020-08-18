<?php

use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::query()
            ->where('name', '=', 'admin')
            ->first();
        $admin->roles()->sync(
            Role::query()->where('slug', '=', 'admin')
                ->get()
        );

        $moderator = User::query()
            ->where('name', '=', 'moderator')
            ->first();

        $userRole = Role::query()->where('slug', '=', 'user')
            ->get();

        $moderator->roles()->sync($userRole);

        $moderator->givePermissionsTo(
            'can_generate_prices'
        );

        User::query()
            ->where('name', '=', 'user')
            ->first()->roles()->sync($userRole);


    }
}
