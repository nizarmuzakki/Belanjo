<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->increments('id_pelanggan');
            $table->string('nama');
            $table->string('email')->nullable()->unique();
            $table->string('telepon')->nullable();
            $table->text('alamat')->nullable();
           $table->timestamp('dibuat_pada')->useCurrent();

        });
    }

    public function down()
    {
        Schema::dropIfExists('pelanggan');
    }
};
