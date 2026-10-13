<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->increments('id_produk');
            $table->unsignedInteger('id_kategori');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori');
            $table->string('kode_sku')->unique();
            $table->string('nama_produk');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_pokok');
            $table->decimal('harga_jual');
            $table->string('satuan');
            $table->integer('jumlah_stok')->default(0);
            $table->integer('stok_minimum')->default(0);
            $table->boolean('status_aktif')->default(true);
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->nullable();

            $table->index(['id_kategori']);
            $table->index(['nama_produk']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('produk');
    }
};
