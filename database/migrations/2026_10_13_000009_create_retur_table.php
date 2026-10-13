<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('retur', function (Blueprint $table) {
            $table->increments('id_retur');
            $table->string('id_transaksi');
            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi');
            $table->unsignedInteger('id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('produk');
            $table->integer('jumlah');
            $table->text('alasan')->nullable();
            $table->timestamp('tanggal_retur');
            $table->unsignedInteger('id_pengguna');
            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna');

            $table->index(['id_transaksi']);
            $table->index(['id_produk']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('retur');
    }
};
