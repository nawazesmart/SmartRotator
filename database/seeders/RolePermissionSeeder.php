<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'super-admin']);

        $permissions = [
            [
                'prefix' => 'user',
                'name' => 'view user'
            ],
            [
                'prefix' => 'user',
                'name' => 'add user'
            ],
            [
                'prefix' => 'user',
                'name' => 'edit user'
            ],
            [
                'prefix' => 'user',
                'name' => 'delete user'
            ],
            [
                'prefix' => 'role',
                'name' => 'view role'
            ],
            [
                'prefix' => 'role',
                'name' => 'view permission'
            ],
            [
                'prefix' => 'role',
                'name' => 'add role'
            ],
            [
                'prefix' => 'role',
                'name' => 'edit role'
            ],
            [
                'prefix' => 'role',
                'name' => 'delete role'
            ],
            [
                'prefix' => 'dashboard',
                'name' => 'view dashboard'
            ],
            [
                'prefix' => 'links',
                'name' => 'view links'
            ],
            [
                'prefix' => 'links',
                'name' => 'view all links'
            ],
            [
                'prefix' => 'links',
                'name' => 'add links'
            ],
            [
                'prefix' => 'links',
                'name' => 'edit links'
            ],
            [
                'prefix' => 'links',
                'name' => 'delete links'
            ],
        ];
        foreach ($permissions as $item) {
            Permission::create($item);
        }
        $role->syncPermissions(Permission::all());

        $user = User::first();
        $user->assignRole($role);
        Role::create(['name' => 'user']);
    }
}
