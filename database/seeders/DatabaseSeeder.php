<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = \App\Models\User::factory()->create([
            'name' => 'Muhammad Iqbal',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'role' => 'super_admin',
        ]);

        \App\Models\Superadmin::factory()->create([
            'user_id' => $user->id,
            'username' => 'iqbalmtgjr',
            'jenis_kelamin' => 'laki-laki',
            'no_hp' => '08996979079',
            'alamat' => 'jl. mensiku jaya, menyumbung tengah, sintang',
        ]);
    }
}
