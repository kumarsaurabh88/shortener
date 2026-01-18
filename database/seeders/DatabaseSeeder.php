<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
        ]);

        // Create SuperAdmin User
        $superAdminRole = Role::where('name', Role::SUPER_ADMIN)->first();
        User::firstOrCreate(
            ['email' => 'admin@urlshortener.local'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role_id' => $superAdminRole->id,
                'company_id' => null,
            ]
        );

        // Create sample company with Admin and Members
        $company = Company::firstOrCreate(
            ['slug' => 'demo-company'],
            ['name' => 'Demo Company']
        );

        $adminRole = Role::where('name', Role::ADMIN)->first();
        $memberRole = Role::where('name', Role::MEMBER)->first();

        User::firstOrCreate(
            ['email' => 'admin@demo.local'],
            [
                'name' => 'Company Admin',
                'password' => Hash::make('password'),
                'company_id' => $company->id,
                'role_id' => $adminRole->id,
            ]
        );

        User::firstOrCreate(
            ['email' => 'member@demo.local'],
            [
                'name' => 'Company Member',
                'password' => Hash::make('password'),
                'company_id' => $company->id,
                'role_id' => $memberRole->id,
            ]
        );
    }
}
