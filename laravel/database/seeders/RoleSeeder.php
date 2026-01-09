<?php

namespace Database\Seeders;


use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
 public function run(): void
{
    $roles = [
        ['name' => 'admin', 'description' => 'Can manage everything'],
        ['name' => 'manager', 'description' => 'Can create/update projects and assign tasks'],
        ['name' => 'staff', 'description' => 'Can view and update assigned tasks'],
    ];

    foreach ($roles as $roleData) {
        Role::firstOrCreate(
            ['name' => $roleData['name']],
            $roleData
        );
    }
}
}
