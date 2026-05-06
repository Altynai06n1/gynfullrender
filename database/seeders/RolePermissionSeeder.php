<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
     
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

      
        Permission::create(['name' => 'create music-tracks']);
        Permission::create(['name' => 'edit music-tracks']);
        Permission::create(['name' => 'delete music-tracks']);
        Permission::create(['name' => 'publish music-tracks']);
        Permission::create(['name' => 'view music-tracks']);

        Permission::create(['name' => 'create music-news']);
        Permission::create(['name' => 'edit music-news']);
        Permission::create(['name' => 'delete music-news']);
        Permission::create(['name' => 'publish music-news']);
        Permission::create(['name' => 'view music-news']);

        Permission::create(['name' => 'create records']);
        Permission::create(['name' => 'edit records']);
        Permission::create(['name' => 'delete records']);
        Permission::create(['name' => 'view records']);

       
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage roles']);
        Permission::create(['name' => 'view analytics']);
        Permission::create(['name' => 'manage settings']);

        

      
        $superAdmin = Role::create(['name' => 'super-admin']);
        $superAdmin->givePermissionTo(Permission::all());

    
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'create music-tracks',
            'edit music-tracks',
            'delete music-tracks',
            'publish music-tracks',
            'view music-tracks',
            'create music-news',
            'edit music-news',
            'delete music-news',
            'publish music-news',
            'view music-news',
            'create records',
            'edit records',
            'delete records',
            'view records',
            'view analytics',
        ]);

        $moderator = Role::create(['name' => 'moderator']);
        $moderator->givePermissionTo([
            'create music-tracks',
            'edit music-tracks',
            'publish music-tracks',
            'view music-tracks',
            'create music-news',
            'edit music-news',
            'publish music-news',
            'view music-news',
            'create records',
            'edit records',
            'view records',
        ]);

   
        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo([
            'view music-tracks',
            'view music-news',
            'create records',
            'view records',
        ]);
    }
}

