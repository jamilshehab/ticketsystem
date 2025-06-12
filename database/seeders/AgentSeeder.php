<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $user = User::create([
    'firstName' => 'Jamil',
    'lastName' => 'Shehab',
    'email' => 'jamil@support.com',
    'password' => Hash::make('password123'),
     ]);
    $user->assignRole('agent');
    }
}
