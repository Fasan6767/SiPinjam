<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    // 1 akun admin
    User::factory()->admin()->create([
    'name' => 'Admin Lab',
    'email' => 'admin@sipinjam.test',
    ]);
    // 1 akun mahasiswa yang mudah diingat untuk uji coba
    User::factory()->create([
    'name' => 'Mahasiswa Demo',
    'nim' => '22410001',
    'email' => 'mhs@sipinjam.test',
    ]);
    // 10 mahasiswa acak
    User::factory()->count(10)->create();
    // Kategori dan alat
    $this->call([
    CategorySeeder::class,
    LoanSeeder::class,
    ]);
    }
}
