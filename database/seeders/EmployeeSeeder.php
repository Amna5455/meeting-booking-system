<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       

     

        $user = User::create([
            'first_name'        => 'Anonymous',
            'last_name'         => 'User',
            'email'             => 'customer@space.io',
            'password'          => bcrypt('viital'),
            'status'            => 1
        ]);
        Employee::create([
            'user_id' => $user->id,
            'department_id' => 1
        ]);
        $user2 = User::create([
            'first_name'        => 'Fnonymous',
            'last_name'         => 'Dumy',
            'email'             => 'dumy@space.io',
            'password'          => bcrypt('viital'),
            'status'            => 1
        ]);
        Employee::create([
            'user_id' => $user2->id,
            'department_id' => 2
        ]);

        $user3 = User::create([
            'first_name'        => 'Demo',
            'last_name'         => 'Customer',
            'email'             => 'customer@bitsinc.com',
            'password'          => bcrypt('viital'),
            'status'            => 1

        ]);
        Employee::create([
            'user_id' => $user3->id,
            'department_id' => 3
        ]);

        $user4 = User::create([
            'first_name'        => 'Samantha',
            'last_name'         => 'McDevitt',
            'email'             => 'samantha@wearetwogether.com',
            'password'          => bcrypt('delltesting123!'),
            'status'            => 1

        ]);
        Employee::create([
            'user_id' => $user4->id,
            'department_id' => 1
        ]);

        $user5 = User::create([
            'first_name'        => 'Newtest',
            'last_name'         => 'One',
            'email'             => 'newtest1@wearetwogether.com',
            'password'          => bcrypt('delltesting123!'),
            'status'            => 1

        ]);

        Employee::create([
            'user_id' => $user5->id,
            'department_id' => 2
        ]);
        $role = Role::find(2);

        $user->assignRole([$role->id]);
        $user2->assignRole([$role->id]);
        $user3->assignRole([$role->id]);
        $user4->assignRole([$role->id]);
        $user5->assignRole([$role->id]);

        
    }
}
