<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class AclSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ([
                     'admin',
                     'user',
                     'moderator'
                 ] as $role) {
            (new Role([
                'name' => ucfirst($role),
                'slug' => $role,
            ]))->save();
        }
        $permissions = [];
        foreach ([
                     'can_see_prices' => 'Can See Prices',
                     'can_generate_prices' => 'Can Generate Prices',
                     'can_see_peoples' => 'Can See Peoples',
                     'can_generate_peoples' => 'Can Generate Peoples'
                 ] as $slug => $name) {
            $permission = new Permission([
                'slug' => $slug,
                'name' => $name
            ]);
            $permission->save();
            $permissions[] = $permission;
        }
        $admin = Role::query()
            ->where('slug', '=', 'admin')
            ->first();
        $admin->permissions()->saveMany($permissions);

        $user = Role::query()
            ->where('slug', '=', 'user')
            ->first();

        $user->permissions()->saveMany(
            Permission::query()
                ->whereIn('slug', [
                    'can_see_prices',
                    'can_see_peoples'
                ])
                ->get()
        );

    }
}
