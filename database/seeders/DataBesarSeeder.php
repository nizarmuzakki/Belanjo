<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataBesarSeeder extends Seeder
{
    private int $ukuranBatch = 1000;

    public function run(): void
    {
        DB::disableQueryLog();   // supaya memori tidak membengkak
        $mulai = microtime(true);

        $this->seedPengguna(100000);

        $detik = round(microtime(true) - $mulai, 1);
        $this->command->info("Selesai dalam {$detik} detik");
    }

    private function seedPengguna(int $jumlah): void
    {
        $sekarang = now();
        $nomor = 0;
        $jumlahBatch = intdiv($jumlah, $this->ukuranBatch);

        for ($i = 0; $i < $jumlahBatch; $i++) {
            fake()->unique(true);   // reset daftar "unik" Faker tiap batch

            $baris = Pengguna::factory()
                ->count($this->ukuranBatch)
                ->make()
                ->map(function ($pengguna) use (&$nomor, $sekarang) {
                    $nomor++;
                    $data = $pengguna->getAttributes();
                    $data['email'] = "bulk{$nomor}@belanjo.test";   // dijamin unik
                    $data['dibuat_pada'] = $sekarang;
                    $data['diperbarui_pada'] = $sekarang;
                    return $data;
                })
                ->all();

            Pengguna::insert($baris);

            if (($i + 1) % 10 === 0) {
                $this->command->info('Pengguna: ' . ($i + 1) * $this->ukuranBatch . " / {$jumlah}");
            }
        }
    }
}