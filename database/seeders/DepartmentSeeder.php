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
 
        $layal = User::create([
            'firstName' => 'Layal',
            'lastName' => 'Zein',
            'email' => 'layal@sales.com',
            'password' => Hash::make('password123'),
            'department_id' => $sales->id,
        ]);

        $layal->assignRole('agent');

        $jamil = User::create([
         'firstName' => 'Jamil',
         'lastName' => 'Shehab',
         'email' => 'jamil@support.com',
         'password' => Hash::make('password123'),
         'department_id' => $support->id,
          ]);
       $jamil->assignRole('agent');

        $mohammad = User::create([
        'firstName' => 'Mohammad',
        'lastName' => 'Itani',
        'email' => 'itani@support.com',
        'password' => Hash::make('password123'),
        ]);

        $mohammad->assignRole('agent');

        $omar = User::create([
        'firstName' => 'Omar',
        'lastName' => 'Itani',
        'email' => 'omar@support.com',
        'password' => Hash::make('password123'),
         ]);

        $omar->assignRole('agent');
         
    }
}
