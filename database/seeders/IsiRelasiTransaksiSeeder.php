<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class IsiRelasiTransaksiSeeder extends Seeder
{
    private const UKURAN_BATCH = 1_000;

    private const MAKSIMAL_PELANGGAN_DAN_PENGGUNA = 100;

    private const MAKSIMAL_PERANGKAT = 10;

    public function run(): void
    {
        DB::disableQueryLog();

        $transaksiBelumLengkap = DB::table('transaksi')
            ->where(function ($query): void {
                $query->whereNull('id_pelanggan')
                    ->orWhereNull('id_pengguna')
                    ->orWhereNull('id_perangkat')
                    ->orWhereNull('id_log_sinkronisasi');
            });

        $jumlahTransaksi = (clone $transaksiBelumLengkap)->count();

        if ($jumlahTransaksi === 0) {
            if (DB::table('transaksi')->count() === 0) {
                $this->siapkanPelanggan(self::MAKSIMAL_PELANGGAN_DAN_PENGGUNA);
                $this->siapkanPengguna(self::MAKSIMAL_PELANGGAN_DAN_PENGGUNA);
                $this->siapkanLogPerangkat(self::MAKSIMAL_PERANGKAT);
            }

            $this->command->info('Semua relasi transaksi sudah terisi.');

            return;
        }

        if ($jumlahTransaksi < 2) {
            throw new RuntimeException('Minimal diperlukan dua transaksi agar pelanggan dan pengguna memiliki lebih dari satu transaksi.');
        }

        $jumlahPelangganDanPengguna = min(
            self::MAKSIMAL_PELANGGAN_DAN_PENGGUNA,
            intdiv($jumlahTransaksi, 2),
        );
        $jumlahPerangkat = min(self::MAKSIMAL_PERANGKAT, $jumlahPelangganDanPengguna);

        $idPelanggan = $this->siapkanPelanggan($jumlahPelangganDanPengguna);
        $idPengguna = $this->siapkanPengguna($jumlahPelangganDanPengguna);
        $logPerangkat = $this->siapkanLogPerangkat($jumlahPerangkat);
        $indeks = 0;
        $namaTabelSementara = 'transaksi_relasi_temp';
        $grammar = DB::connection()->getQueryGrammar();
        $tabelSementara = $grammar->wrapTable($namaTabelSementara);

        DB::statement(
            "CREATE TEMPORARY TABLE {$tabelSementara} ("
                .$grammar->wrap('id_transaksi').' VARCHAR(255) NOT NULL PRIMARY KEY, '
                .$grammar->wrap('id_pelanggan').' INT UNSIGNED NOT NULL, '
                .$grammar->wrap('id_pengguna').' INT UNSIGNED NOT NULL, '
                .$grammar->wrap('id_perangkat').' VARCHAR(255) NOT NULL, '
                .$grammar->wrap('id_log_sinkronisasi').' INT UNSIGNED NOT NULL'
                .')',
        );

        try {
            $transaksiBelumLengkap->chunkById(
                self::UKURAN_BATCH,
                function ($transaksis) use ($namaTabelSementara, $idPelanggan, $idPengguna, $logPerangkat, $jumlahTransaksi, &$indeks): void {
                    $relasiTransaksi = [];

                    foreach ($transaksis as $transaksi) {
                        $indeksRelasi = $indeks % count($idPelanggan);
                        $perangkat = $logPerangkat[$indeks % count($logPerangkat)];

                        $relasiTransaksi[] = [
                            'id_transaksi' => $transaksi->id_transaksi,
                            'id_pelanggan' => $transaksi->id_pelanggan ?? $idPelanggan[$indeksRelasi],
                            'id_pengguna' => $transaksi->id_pengguna ?? $idPengguna[$indeksRelasi],
                            'id_perangkat' => $transaksi->id_perangkat ?? $perangkat['id_perangkat'],
                            'id_log_sinkronisasi' => $transaksi->id_log_sinkronisasi ?? $perangkat['id_log'],
                        ];

                        $indeks++;
                    }

                    DB::table($namaTabelSementara)->insert($relasiTransaksi);

                    if ($indeks % 10_000 === 0 || $indeks === $jumlahTransaksi) {
                        $this->command->info("Pemetaan relasi disiapkan: {$indeks} / {$jumlahTransaksi}");
                    }
                },
                'id_transaksi',
                'id_transaksi',
            );

            $tabelTransaksi = $grammar->wrapTable('transaksi as t');
            $relasiSementara = $grammar->wrapTable($namaTabelSementara.' as r');
            $primaryKeyTransaksi = $grammar->wrap('t.id_transaksi');
            $primaryKeyRelasi = $grammar->wrap('r.id_transaksi');
            $kolomRelasi = ['id_pelanggan', 'id_pengguna', 'id_perangkat', 'id_log_sinkronisasi'];
            $set = array_map(
                fn (string $kolom): string => $grammar->wrap("t.{$kolom}").' = '.$grammar->wrap("r.{$kolom}"),
                $kolomRelasi,
            );

            DB::statement(
                "UPDATE {$tabelTransaksi} INNER JOIN {$relasiSementara}"
                    ." ON {$primaryKeyTransaksi} = {$primaryKeyRelasi}"
                    .' SET '.implode(', ', $set),
            );
        } finally {
            DB::statement("DROP TEMPORARY TABLE IF EXISTS {$tabelSementara}");
        }

        $this->command->info("Relasi transaksi terisi: {$indeks} / {$jumlahTransaksi}");
    }

    /**
     * @return list<int>
     */
    private function siapkanPelanggan(int $jumlah): array
    {
        $idPelanggan = DB::table('pelanggan')
            ->orderBy('id_pelanggan')
            ->limit($jumlah)
            ->pluck('id_pelanggan')
            ->all();

        $pelangganBaru = [];

        while (count($idPelanggan) + count($pelangganBaru) < $jumlah) {
            $pelangganBaru[] = [
                'nama' => fake()->name(),
                'email' => null,
                'telepon' => fake()->phoneNumber(),
                'alamat' => fake()->address(),
                'dibuat_pada' => now(),
            ];
        }

        if ($pelangganBaru !== []) {
            DB::table('pelanggan')->insert($pelangganBaru);
        }

        return DB::table('pelanggan')
            ->orderBy('id_pelanggan')
            ->limit($jumlah)
            ->pluck('id_pelanggan')
            ->map(fn ($id): int => (int) $id)
            ->all();
    }

    /**
     * @return list<int>
     */
    private function siapkanPengguna(int $jumlah): array
    {
        $idPengguna = DB::table('pengguna')
            ->where('status_aktif', true)
            ->where('peran', 'kasir')
            ->orderBy('id_pengguna')
            ->limit($jumlah)
            ->pluck('id_pengguna')
            ->all();

        $penggunaBaru = $jumlah - count($idPengguna);

        if ($penggunaBaru > 0) {
            Pengguna::factory()
                ->count($penggunaBaru)
                ->create(['peran' => 'kasir', 'status_aktif' => true]);
        }

        return DB::table('pengguna')
            ->where('status_aktif', true)
            ->where('peran', 'kasir')
            ->orderBy('id_pengguna')
            ->limit($jumlah)
            ->pluck('id_pengguna')
            ->map(fn ($id): int => (int) $id)
            ->all();
    }

    /**
     * @return list<array{id_perangkat: string, id_log: int}>
     */
    private function siapkanLogPerangkat(int $jumlah): array
    {
        $idPerangkat = DB::table('perangkat_pos')
            ->orderBy('id_perangkat')
            ->limit($jumlah)
            ->pluck('id_perangkat')
            ->all();

        while (count($idPerangkat) < $jumlah) {
            $id = (string) Str::uuid();

            DB::table('perangkat_pos')->insert([
                'id_perangkat' => $id,
                'kode_perangkat' => 'POS-'.strtoupper(Str::random(12)),
                'nama_perangkat' => 'Perangkat POS '.(count($idPerangkat) + 1),
                'status_aktif' => true,
                'terakhir_sinkron' => now(),
                'dibuat_pada' => now(),
            ]);

            $idPerangkat[] = $id;
        }

        $logPerangkat = [];

        foreach ($idPerangkat as $id) {
            $idLog = DB::table('log_sinkronisasi')
                ->where('id_perangkat', $id)
                ->orderBy('id_log')
                ->value('id_log');

            if ($idLog === null) {
                $idLog = DB::table('log_sinkronisasi')->insertGetId([
                    'id_perangkat' => $id,
                    'waktu_mulai' => now(),
                    'waktu_selesai' => now(),
                    'status' => 'berhasil',
                    'jumlah_data_dikirim' => 10_000,
                    'jumlah_data_berhasil' => 10_000,
                    'jumlah_percobaan' => 1,
                    'pesan_kesalahan' => null,
                ]);
            }

            $logPerangkat[] = [
                'id_perangkat' => (string) $id,
                'id_log' => (int) $idLog,
            ];
        }

        return $logPerangkat;
    }
}
