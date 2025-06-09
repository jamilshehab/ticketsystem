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

            $roles=['admin','manager','agent','client'];

            foreach ($roles as $role) {
                Role::firstOrCreate(['name'=>$role,
                'guard_name' => 'web', // ← Explicitly set guard
                 ]); 
                
            }
             // 2. Create Permissions (Ticket-related)
          $permissions = [
            'create tickets',
            'view all tickets',
            'view own tickets',
            'edit all tickets',
            'edit assigned tickets',
            'delete tickets',
            'assign tickets',
            'close tickets',
        ];
        
        foreach($permissions as $permission){
            Permission::firstOrCreate(['name'=>$permission]);
        }
        $admin=Role::findByName('admin');
        $admin->givePermissionTo(Permission::all());
        $manager=Role::findByName('manager');
        $manager->givePermissionTo(['view all tickets','assign tickets','close tickets']);
        $agent=Role::findByName('agent');
        $agent->givePermissionTo(['create tickets','view own tickets','edit assigned tickets']);
        $client=Role::findByName('client');
        $client->givePermissionTo([
            'create tickets',  
            'view own tickets'  
        ]);     
       }
}
