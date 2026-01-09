<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run(): void
{
    $users = [
        [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ],
        [
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => bcrypt('password123'),
            'role' => 'manager',
        ],
        [
            'name' => 'Staff One',
            'email' => 'staff1@example.com',
            'password' => bcrypt('password123'),
            'role' => 'staff',
        ],
        [
            'name' => 'Staff Two',
            'email' => 'staff2@example.com',
            'password' => bcrypt('password123'),
            'role' => 'staff',
        ],
    ];

    foreach ($users as $userData) {
        $roleName = $userData['role'];
        unset($userData['role']);

        $user = User::firstOrCreate(
            ['email' => $userData['email']],
            $userData
        );

        $role = Role::where('name', $roleName)->first();
        if ($role) {
            $user->roles()->syncWithoutDetaching($role->id);
        }
    }
}
}
