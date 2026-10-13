<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->string('id_transaksi')->primary();
            $table->string('kode_transaksi')->unique();
            $table->unsignedInteger('id_pelanggan')->nullable();
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan');
            $table->unsignedInteger('id_pengguna')->nullable();
            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna');
            $table->string('id_perangkat')->nullable();
            $table->foreign('id_perangkat')->references('id_perangkat')->on('perangkat_pos');
            $table->unsignedInteger('id_log_sinkronisasi')->nullable();
            $table->foreign('id_log_sinkronisasi')->references('id_log')->on('log_sinkronisasi');
            $table->timestamp('tanggal_transaksi');
            $table->enum('status', ['pending', 'lunas', 'selesai', 'dibatalkan', 'diretur'])->default('pending');
            $table->enum('saluran', ['online', 'offline']);
            $table->enum('status_sinkronisasi', ['tersinkron', 'menunggu_sinkron'])->default('tersinkron');
            $table->string('subtotal')->default(0);
            $table->string('diskon')->default(0);
            $table->string('pajak')->default(0);
            $table->string('total_bayar')->default(0);
            $table->timestamp('waktu_sinkronisasi')->nullable();
            $table->timestamp('dibuat_pada')->useCurrent();

            $table->index(['tanggal_transaksi']);
            $table->index(['id_pelanggan']);
            $table->index(['id_pengguna']);
            $table->index(['status_sinkronisasi', 'saluran']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};
