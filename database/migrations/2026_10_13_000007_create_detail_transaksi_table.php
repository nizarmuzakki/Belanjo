<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->increments('id_detail');
            $table->string('id_transaksi');
            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi')->cascadeOnDelete();
            $table->unsignedInteger('id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('produk');
            $table->integer('jumlah');
            $table->decimal('harga_satuan');
            $table->decimal('harga_pokok');
            $table->string('subtotal');

            $table->unique(['id_transaksi', 'id_produk']);
            $table->index(['id_produk']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
