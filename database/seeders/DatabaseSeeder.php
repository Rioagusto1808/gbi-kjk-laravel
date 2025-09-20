<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);
        $this->call(JemaatSeeder::class);
        $this->call(PelayananSeeder::class);

        $super = User::firstOrCreate(
        ['email' => 'admin@gmail.com'],
        ['name' => 'Admin Gacor', 'password' => bcrypt('123')]
        );

        $super->assignRole('superadmin');
    }

    
}
