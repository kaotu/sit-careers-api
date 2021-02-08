<?php

use Illuminate\Database\Seeder;

use App\Models\RolePermission;
use App\Models\Permission;
use App\Models\Role;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::where('role_name', 'admin')->first();
        $permissions = Permission::all();

        foreach ($permissions as  $permission) {
            $rolePermission = new RolePermission();
            $rolePermission->permission_id = $permission->permission_id;
            $rolePermission->role_id = $roleAdmin->role_id;
            $rolePermission->save();
        }        
    }
}
