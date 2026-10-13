<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->increments('id_pembayaran');
            $table->string('id_transaksi');
            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi');
            $table->enum('metode_pembayaran', ['tunai', 'transfer', 'e-wallet', 'kartu']);
            $table->string('jumlah_dibayar');
            $table->enum('status_pembayaran', ['menunggu', 'berhasil', 'gagal'])->default('menunggu');
            $table->timestamp('dibayar_pada')->nullable();

            $table->index(['id_transaksi']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
};
