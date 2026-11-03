<?php

namespace Database\Factories;

use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

/**
 * @extends Factory<Transaksi>
 */
class TransaksiFactory extends Factory
{
    private static ?array $relasi = null;

    private static int $indeksRelasi = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $relasi = $this->ambilRelasi();
        $indeks = self::$indeksRelasi++;
        $pasanganPerangkat = $relasi['perangkat'][$indeks % count($relasi['perangkat'])];
        $subtotal = fake()->numberBetween(10_000, 5_000_000);
        $diskon = fake()->numberBetween(0, min(500_000, $subtotal));
        $pajak = (int) round(($subtotal - $diskon) * 0.11);
        $tanggalTransaksi = fake()->dateTimeBetween('-2 years', 'now')->format('Y-m-d H:i:s');

        return [
            'id_transaksi' => (string) Str::uuid(),
            'kode_transaksi' => 'TRX-'.strtoupper((string) Str::uuid()),
            'id_pelanggan' => $relasi['pelanggan'][$indeks % count($relasi['pelanggan'])],
            'id_pengguna' => $relasi['pengguna'][$indeks % count($relasi['pengguna'])],
            'id_perangkat' => $pasanganPerangkat['id_perangkat'],
            'id_log_sinkronisasi' => $pasanganPerangkat['id_log'],
            'tanggal_transaksi' => $tanggalTransaksi,
            'status' => fake()->randomElement(['pending', 'lunas', 'selesai', 'dibatalkan', 'diretur']),
            'saluran' => fake()->randomElement(['online', 'offline']),
            'status_sinkronisasi' => fake()->randomElement(['tersinkron', 'menunggu_sinkron']),
            'subtotal' => (string) $subtotal,
            'diskon' => (string) $diskon,
            'pajak' => (string) $pajak,
            'total_bayar' => (string) ($subtotal - $diskon + $pajak),
            'waktu_sinkronisasi' => null,
            'dibuat_pada' => $tanggalTransaksi,
        ];
    }

    /**
     * @return array{
     *     pelanggan: list<int>,
     *     pengguna: list<int>,
     *     perangkat: list<array{id_perangkat: string, id_log: int}>
     * }
     */
    private function ambilRelasi(): array
    {
        if (self::$relasi !== null) {
            return self::$relasi;
        }

        $pelanggan = DB::table('pelanggan')
            ->orderBy('id_pelanggan')
            ->limit(100)
            ->pluck('id_pelanggan')
            ->map(fn ($id): int => (int) $id)
            ->all();
        $pengguna = DB::table('pengguna')
            ->where('status_aktif', true)
            ->where('peran', 'kasir')
            ->orderBy('id_pengguna')
            ->limit(100)
            ->pluck('id_pengguna')
            ->map(fn ($id): int => (int) $id)
            ->all();
        $perangkat = DB::table('perangkat_pos as perangkat')
            ->join('log_sinkronisasi as log', 'log.id_perangkat', '=', 'perangkat.id_perangkat')
            ->orderBy('perangkat.id_perangkat')
            ->orderBy('log.id_log')
            ->limit(10)
            ->get(['perangkat.id_perangkat', 'log.id_log'])
            ->map(fn ($relasi): array => [
                'id_perangkat' => (string) $relasi->id_perangkat,
                'id_log' => (int) $relasi->id_log,
            ])
            ->all();

        if ($pelanggan === [] || $pengguna === [] || $perangkat === []) {
            throw new RuntimeException('Jalankan IsiRelasiTransaksiSeeder sebelum membuat transaksi agar foreign key valid.');
        }

        return self::$relasi = [
            'pelanggan' => $pelanggan,
            'pengguna' => $pengguna,
            'perangkat' => $perangkat,
        ];
    }
}
