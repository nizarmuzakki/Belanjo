<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    private const JUMLAH = 100_000;

    private const UKURAN_BATCH = 1_000;

    public function run(): void
    {
        DB::disableQueryLog();

        $this->call(IsiRelasiTransaksiSeeder::class);

        for ($offset = 0; $offset < self::JUMLAH; $offset += self::UKURAN_BATCH) {
            $jumlahBatch = min(self::UKURAN_BATCH, self::JUMLAH - $offset);
            $transaksis = Transaksi::factory()
                ->count($jumlahBatch)
                ->make()
                ->map(fn (Transaksi $transaksi) => $transaksi->getAttributes())
                ->all();

            DB::table('transaksi')->insert($transaksis);

            if (($offset + $jumlahBatch) % 10_000 === 0) {
                $this->command->info('Transaksi: '.($offset + $jumlahBatch).' / '.self::JUMLAH);
            }
        }

        $this->call(IsiRelasiTransaksiSeeder::class);
    }
}
