<?php

namespace Database\Factories;

use App\Models\Pengguna;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<Pengguna>
 */
class PenggunaFactory extends Factory
{
    protected static ?string $password = null;
    
    public function definition(): array
    {
    
        return [
            'nama'         => fake()->name(),
            'email'        => fake()->unique()->safeEmail(),
'kata_sandi' => static::$password ??= Hash::make('password'),
            // 'kata_sandi'   => Hash::make('password'),
            'peran'        => fake()->randomElement(['pemilik', 'manajer', 'admin_gudang', 'kasir']),
            'telepon'      => fake()->phoneNumber(),
            'status_aktif' => true,
        ];
    }
}
