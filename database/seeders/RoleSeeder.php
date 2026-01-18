<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => Role::SUPER_ADMIN, 'description' => 'System Administrator'],
            ['name' => Role::ADMIN, 'description' => 'Company Administrator'],
            ['name' => Role::MEMBER, 'description' => 'Company Member'],
            ['name' => Role::SALES, 'description' => 'Sales Person'],
            ['name' => Role::MANAGER, 'description' => 'Company Manager'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }
    }
}
