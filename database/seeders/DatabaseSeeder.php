<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $roles = ['admin', 'user', 'super admin'];
        foreach ($roles as $role) {
            Role::create([
                'guard_name' => "web",
                'name' => $role,
            ]);
        }


        $users = [
            [
                "name" => "Admin",
                "email" => "admin@gmail.com",
                "password" => Hash::make("password"),
                "role" => "admin"
            ],
        ];

        foreach ($users as $user) {
            $newUser = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),

            ]);
            $newUser->assignRole($user['role']);
        }

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
