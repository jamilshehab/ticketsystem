<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    
    public function run(): void
    {
            //clear cache permission
            app()->make(PermissionRegistrar::class)->forgetCachedPermissions();

        // 1. Create Roles
        $roles = ['manager', 'agent', 'client'];
        
        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name' => $role, 'guard_name' => 'web'],
                ['name' => $role, 'guard_name' => 'web']
            );
        }

        // 2. Create Permissions (Ticket-related)
        $permissions = [
            'create tickets',
            'view all tickets',
            'view own tickets',
            'edit own tickets',
            'edit all tickets',
            'edit assigned tickets', // ✅ add this line
            'delete tickets',
            'delete own tickets',  // Added for clients to delete their own tickets
            'assign tickets',
            'close tickets',
            'reopen tickets',  // Added if you want clients to reopen closed tickets
        ];
        
        foreach($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        // 3. Assign permissions to roles
        

        $manager = Role::findByName('manager');
        $manager->givePermissionTo([
            'view all tickets',
            'assign tickets',
            'close tickets',
            'reopen tickets'
        ]);

        $agent = Role::findByName('agent');
        $agent->givePermissionTo([
            'create tickets',
            'view own tickets',
            'edit assigned tickets',
            'close tickets'
        ]);

        $client = Role::findByName('client');
        $client->givePermissionTo([
            'create tickets',
            'view own tickets',
            'edit own tickets',  // Allow clients to edit their own tickets
            'delete own tickets' // Allow clients to delete their own tickets
        ]);
            
    }
}