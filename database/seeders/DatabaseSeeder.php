<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Todo; // Tambahkan ini untuk model Todo
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Tambahkan ini untuk Hash
use Illuminate\Support\Str; // Tambahkan ini untuk Str

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_admin' => true,
        ]);

        User::factory(20)->create(); // Hapus spasi berlebih
        Todo::factory(1)->create([
            'user_id' => User::inRandomOrder()->first()->id,
        ]);
    }
}
