<?php

namespace Database\Seeders;

use App\Models\Jemaat;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class JemaatSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // 🔑 Superadmin tetap dibuat manual
        $super = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Gacor',
                'password' => Hash::make('123'),
            ]
        );
        $super->assignRole('superadmin');

        // 🔑 Buat 10 Jemaat + User
        for ($i = 1; $i <= 10; $i++) {
            $jemaat = Jemaat::create([
                'name' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'tanggal_lahir' => $faker->date(),
                'alamat' => $faker->address,
                'no_hp' => $faker->numerify('08##########'),
                'status_pernikahan' => $faker->randomElement(['Lajang', 'Menikah', 'Duda/Janda']),
                'pekerjaan' => $faker->jobTitle,
                'aktif' => true,
            ]);

            $user = User::create([
                'name' => $jemaat->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'jemaat_id' => $jemaat->id,
            ]);

            $user->assignRole('jemaat');
        }
    }
}
