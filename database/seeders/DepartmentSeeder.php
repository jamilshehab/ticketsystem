<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $support = Department::create(['department_name' => 'Support']);
       $sales = Department::create(['department_name' => 'Sales']);

        // Step 2: Create agents and assign to departments
        $agent1 = User::create([
            'firstName' => 'Jamil',
            'lastName' => 'Shehab',
            'email' => 'jamil@support.com',
            'password' => Hash::make('password123'),
            'department_id' => $support->id,
        ]);
        $agent1->assignRole('agent');

        $agent2 = User::create([
            'firstName' => 'Layal',
            'lastName' => 'Zein',
            'email' => 'layal@sales.com',
            'password' => Hash::make('password123'),
            'department_id' => $sales->id,
        ]);
        $agent2->assignRole('agent');
    }
}
