<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
const CREATED_AT = 'dibuat_pada';
const UPDATED_AT = 'diperbarui_pada';
protected $table = 'pengguna';
protected $primaryKey = 'id_pengguna';

    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table) {
    $table->increments('id_pengguna');   // unsigned int, auto increment, PK, NOT NULL
    $table->string('nama');
    $table->string('email')->unique();
    $table->string('kata_sandi');
    $table->enum('peran', ['pemilik', 'manajer', 'admin_gudang', 'kasir']);
    $table->string('telepon')->nullable();
    $table->boolean('status_aktif')->default(true);   // true, bukan 'true'
    $table->timestamp('dibuat_pada')->useCurrent();
    $table->timestamp('diperbarui_pada')->nullable()->useCurrentOnUpdate();
});
    }

    public function down()
    {
        Schema::dropIfExists('pengguna');
    }
};
