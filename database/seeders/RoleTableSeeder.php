<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Role::truncate();
        $admin          = Role::create(['name' => 'admin']);
        $client         = Role::create(['name' => 'client']);
        $driver         = Role::create(['name' => 'driver']);
        $store_owner    = Role::create(['name' => 'store_owner']);

        //Permissions(stores)
        $add_store     = Permission::create(['name' => 'add store']);
        $edit_store    = Permission::create(['name' => 'edit store']);
        $update_store  = Permission::create(['name' => 'update store']);
        $delete_store  = Permission::create(['name' => 'delete store']);

        //Permissions(drivers)
        $all_driver_permissions = Permission::create(['name' => 'manage driver']);
        $view_driver_permission = Permission::create(['name' => 'view driver']);
        $assign_driver          = Permission::create(['name' => 'assign driver']);
        //assign permissions to admin role
        $admin->givePermissionTo($add_store);
        $admin->givePermissionTo($edit_store);
        $admin->givePermissionTo($update_store);
        $admin->givePermissionTo($delete_store);
        $admin->givePermissionTo($all_driver_permissions);
        $store_owner->givePermissionTo($view_driver_permission);
        $store_owner->givePermissionTo($assign_driver);

        //assign admin role
    }
}
