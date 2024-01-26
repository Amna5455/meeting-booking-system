<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            'admin-dashboard',
            'permission-create',
            'permission-delete',
            'permission-edit',
            'permission-list',

            'employee-list',
            'employee-add',
            'employee-edit',
            'employee-delete',

            'booking-edit',
            'booking-delete',
            'booking-list',
            'booking-create',

            'role-edit',
            'role-delete',
            'role-list',
            'role-create',

            'meeting-calendar-edit',
            'meeting-calendar-delete',
            'meeting-calendar-list',
            'meeting-calendar-create',

            'meeting-booking-edit',
            'meeting-booking-delete',
            'meeting-booking-list',
            'meeting-booking-create',

        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
