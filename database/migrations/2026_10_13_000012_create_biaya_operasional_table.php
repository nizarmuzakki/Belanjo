<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('biaya_operasional', function (Blueprint $table) {
            $table->increments('id_biaya');
            $table->string('kategori_biaya');
            $table->text('deskripsi')->nullable();
            $table->string('jumlah');
            $table->date('tanggal_biaya');
            $table->unsignedInteger('id_pengguna');
            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna');

            $table->index(['tanggal_biaya']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('biaya_operasional');
    }
};
