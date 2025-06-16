<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user=User::create([
          "firstName"=>"Mohammad",
          "lastName"=>"Itani",
          "email"=>"itani@manager.com",
          'password' => Hash::make('password123'),
        ]);
        $user->assignRole("manager");
    }
}
