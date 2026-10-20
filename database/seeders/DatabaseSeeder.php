<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use App\Models\Kategori;
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
        // User::factory(10)->create();

         Pengguna::factory()->count(5)->create();
         Kategori::factory()->count(5)->create();
    }
}
