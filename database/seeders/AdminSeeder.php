<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name' => 'Super',
            'last_name'  => 'Admin',
            'email'      => 'admin@space.io',
            // 'email_verified_at'  => md5('admin@space.io'),
            'password'   => bcrypt('viital'),
            'status'     => 1
        ]);
    }
}
