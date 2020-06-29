<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'spaces']);
        Permission::create(['name' => 'tasks']);
        Permission::create(['name' => 'records']);
        Permission::create(['name' => 'admin']);


        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
        $role = Role::create(['name' => 'attendant']);
        $role->givePermissionTo(['spaces','tasks','records']);
        $role = Role::create(['name' => 'tower']);
        $role->givePermissionTo(['tasks']);



    }
}
