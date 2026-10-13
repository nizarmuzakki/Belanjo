<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('log_sinkronisasi', function (Blueprint $table) {
            $table->increments('id_log');
            $table->string('id_perangkat');
            $table->foreign('id_perangkat')->references('id_perangkat')->on('perangkat_pos');
            $table->timestamp('waktu_mulai');
            $table->timestamp('waktu_selesai')->nullable();
            $table->enum('status', ['berhasil', 'gagal', 'sebagian']);
            $table->integer('jumlah_data_dikirim')->default(0);
            $table->integer('jumlah_data_berhasil')->default(0);
            $table->integer('jumlah_percobaan')->default(1);
            $table->text('pesan_kesalahan')->nullable();

            $table->index(['id_perangkat', 'waktu_mulai']);
            $table->index(['status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('log_sinkronisasi');
    }
};
