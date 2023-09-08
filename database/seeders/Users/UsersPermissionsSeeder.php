<?php

namespace Database\Seeders\Users;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;


class UsersPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['guard_name' => 'web', 'name' => 'dashboard']);
        Permission::create(['guard_name' => 'web', 'name' => 'manage-users']);
        Permission::create(['guard_name' => 'web', 'name' => 'products']);
        Permission::create(['guard_name' => 'web', 'name' => 'add-product']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit-product']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete-product']);

        // create roles and assign existing permissions
        $role1 = Role::create(['guard_name' => 'web', 'name' => 'user']);
        $role1->givePermissionTo('dashboard');
        $role1->givePermissionTo('products');

        $role2 = Role::create(['guard_name' => 'web', 'name' => 'admin']);
        $role2->givePermissionTo('dashboard');
        $role2->givePermissionTo('manage-users');
        $role2->givePermissionTo('products');
        $role2->givePermissionTo('add-product');
        $role2->givePermissionTo('edit-product');
        $role2->givePermissionTo('delete-product');

        // create user
        $user = User::create([
            'fullname' => 'Admin',
            'username' => 'admin',
            'password' => '123456789'
        ]);
        $user->assignRole($role2);
    }
}
