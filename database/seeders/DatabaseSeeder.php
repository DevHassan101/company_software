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

        $roles = ['super admin', 'admin', 'user'];
        foreach ($roles as $role) {
            Role::create([
                'guard_name' => "web",
                'name' => $role,
            ]);
        }


        $users = [
            [
                "name" => "Hassan Shaikh",
                "email" => "hassan@gmail.com",
                "password" => Hash::make("password"),
                "role" => "super admin",
                "designation" => "founder",
                "salary" => 40000
            ],
            [
                "name" => "Hammad Sherani",
                "email" => "hammad@gmail.com",
                "password" => Hash::make("password"),
                "role" => "admin",
                'designation' => 20000
            ],
            [
                "name" => "Daniyal",
                "email" => "daniyal@gmail.com",
                "password" => Hash::make("password"),
                "role" => "admin",
                'designation' => 10000
            ],
        ];

        foreach ($users as $user) {
            $newUser = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
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
