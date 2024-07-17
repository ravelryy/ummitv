<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    private $permissions = [
        'super-privilage',
        'guest-privilage'
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create admin User and assign the role to him.
        $user1 = User::create([
            'name' => 'UmmiTv Official',
            'email' => 'ummi@tv.com',
            'password' => Hash::make('@lh4mdul1ll@h')
        ]);

        $user1 = User::create([
            'name' => 'Admin Ummi',
            'email' => 'admin@ummi.com',
            'password' => Hash::make('b1sm!ll4h')
        ]);

        $user1 = User::create([
            'name' => 'bisamascom',
            'email' => 'bisamascom@ummi.com',
            'password' => Hash::make('bisamascom')
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user1->assignRole([$role->id]);
    }
}
