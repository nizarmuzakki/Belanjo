<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('notifikasi_stok', function (Blueprint $table) {
            $table->increments('id_notifikasi');
            $table->unsignedInteger('id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('produk');
            $table->unsignedInteger('id_penerima');
            $table->foreign('id_penerima')->references('id_pengguna')->on('pengguna');
            $table->enum('jenis', ['stok_menipis', 'stok_habis']);
            $table->string('pesan');
            $table->boolean('sudah_dibaca')->default(false);
            $table->timestamp('dibuat_pada')->useCurrent();

            $table->index(['id_penerima', 'sudah_dibaca']);
            $table->index(['id_produk']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifikasi_stok');
    }
};
