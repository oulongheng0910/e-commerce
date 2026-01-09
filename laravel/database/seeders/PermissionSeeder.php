<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    $permissions = [
        'users.manage',
        'products.create',
        'products.update',
        'products.delete',
        'categories.create',
        'categories.update',
        'categories.delete',
        'projects.create',
        'projects.update',
        'tasks.assign',
        'tasks.update.status',
    ];

    foreach ($permissions as $perm) {
        Permission::firstOrCreate(
            ['name' => $perm],
            ['name' => $perm]  // description can be added later if needed
        );
    }
}
}
