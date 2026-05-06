<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Permissions
        $permissions = [
            'view workouts', 'create workouts', 'edit workouts', 'delete workouts',
            'view gym-news', 'create gym-news', 'edit gym-news', 'delete gym-news',
            'manage users', 'view analytics'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. Roles
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
        $moderatorRole = Role::firstOrCreate(['name' => 'moderator']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        $superAdminRole->syncPermissions(Permission::all());
        $moderatorRole->syncPermissions(['view workouts', 'create workouts', 'view gym-news', 'create gym-news']);
        $userRole->syncPermissions(['view workouts', 'view gym-news']);

        // 3. Test Users
        $users = [
            [
                'name' => 'Admin GymHub',
                'email' => 'admin@gymhub.kz',
                'password' => bcrypt('password123'),
                'role' => 'super-admin'
            ],
            [
                'name' => 'Kairat Trainer',
                'email' => 'trainer@gymhub.kz',
                'password' => bcrypt('password123'),
                'role' => 'moderator'
            ],
            [
                'name' => 'Arman Member',
                'email' => 'member@gymhub.kz',
                'password' => bcrypt('password123'),
                'role' => 'user'
            ],
        ];

        foreach ($users as $u) {
            $user = User::firstOrCreate(['email' => $u['email']], [
                'name' => $u['name'],
                'password' => $u['password'],
            ]);
            $user->syncRoles([$u['role']]);
        }

        echo "Test logins created successfully!\n";
    }
}
