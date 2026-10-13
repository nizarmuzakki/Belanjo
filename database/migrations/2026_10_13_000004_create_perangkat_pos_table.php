<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('perangkat_pos', function (Blueprint $table) {
            $table->string('id_perangkat')->primary();
            $table->string('kode_perangkat')->unique();
            $table->string('nama_perangkat');
            $table->boolean('status_aktif')->default(true);
            $table->timestamp('terakhir_sinkron')->nullable();
            $table->timestamp('dibuat_pada')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('perangkat_pos');
    }
};
