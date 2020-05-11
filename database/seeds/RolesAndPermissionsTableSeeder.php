<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // users permissions
        Permission::create(['name' => 'manage users', 'guard_name' => 'admin']);
        Permission::create(['name' => 'approve users', 'guard_name' => 'admin']);

        // create permissions
        Permission::create(['name' => 'manage permissions', 'guard_name' => 'admin']);
        Permission::create(['name' => 'assign permissions', 'guard_name' => 'admin']);
        Permission::create(['name' => 'manage role-permissions', 'guard_name' => 'admin']);
        Permission::create(['name' => 'manage user-permissions', 'guard_name' => 'admin']);

        // roles permissions
        Permission::create(['name' => 'manage roles', 'guard_name' => 'admin']);
        Permission::create(['name' => 'assign roles', 'guard_name' => 'admin']);

        // roles permissions
        Permission::create(['name' => 'manage status', 'guard_name' => 'admin']);
        Permission::create(['name' => 'assign status', 'guard_name' => 'admin']);

        // sections permissions
        Permission::create(['name' => 'manage sections', 'guard_name' => 'admin']);

        // system permissions
        Permission::create(['name' => 'manage company-settings', 'guard_name' => 'admin']);
        Permission::create(['name' => 'manage access-logs', 'guard_name' => 'admin']);

        // message permissions
        Permission::create(['name' => 'read messages', 'guard_name' => 'admin']);
        Permission::create(['name' => 'reply messages', 'guard_name' => 'admin']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'Super Admin', 'guard_name' => 'admin']);
        // Give permissions to Super Admin
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Admin', 'guard_name' => 'admin'])
                    ->givePermissionTo(['manage users', 'approve users', 'manage permissions', 'assign permissions', 'manage role-permissions', 'manage user-permissions', 'manage roles', 'assign roles', 'manage sections']);

        $role = Role::create(['name' => 'Editor', 'guard_name' => 'admin']);
        $role = Role::create(['name' => 'Support Executive', 'guard_name' => 'admin']);

        // $role->givePermissionTo('edit articles');


    }
}
