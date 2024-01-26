<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nameArray = ['Department 1','Department 2','Department 3'];
        foreach($nameArray as $name){
            Department::create([
                'name' => $name
            ]);
        }
    }
}