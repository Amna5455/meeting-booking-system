<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $role = Role::create(['name' => 'Super Admin']);
        $employeeRole = Role::create(['name' => 'Employee']);

        $empPermissions = [
            'meeting-calendar-edit',
            'meeting-calendar-delete',
            'meeting-calendar-list',
            'meeting-calendar-create',
            'admin-dashboard'
        ];

        $user = User::find(1);
        $permissions = Permission::pluck('id', 'id')->all();
        $empPerm = Permission::whereIn('name',$empPermissions)->pluck('id', 'id')->all();
        $employeeRole->syncPermissions($empPerm);
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
