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

    $layal = User::create([
    'firstName' => 'Layal',
    'lastName' => 'Zein',
    'email' => 'layal@sales.com',
    'password' => Hash::make('password123'),
    ]);

    $layal->assignRole('agent');    
    $jamil = User::create([
    'firstName' => 'Jamil',
    'lastName' => 'Shehab',
    'email' => 'jamil@support.com',
    'password' => Hash::make('password123'),
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
