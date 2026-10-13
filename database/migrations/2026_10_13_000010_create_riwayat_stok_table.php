<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('riwayat_stok', function (Blueprint $table) {
            $table->increments('id_riwayat');
            $table->unsignedInteger('id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('produk');
            $table->enum('jenis_pergerakan', ['masuk', 'keluar', 'retur', 'penyesuaian']);
            $table->integer('jumlah');
            $table->string('id_transaksi')->nullable();
            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi');
            $table->unsignedInteger('id_retur')->nullable();
            $table->foreign('id_retur')->references('id_retur')->on('retur');
            $table->text('catatan')->nullable();
            $table->unsignedInteger('id_pengguna');
            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna');
            $table->timestamp('dicatat_pada')->default(DB::raw('now()'));

            $table->index(['id_produk', 'dicatat_pada']);
            $table->index(['id_transaksi']);
            $table->index(['id_retur']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('riwayat_stok');
    }
};
