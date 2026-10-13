<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'pengguna';
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'nama',
		'email',
		'kata_sandi',
		'peran',
		'telepon',
		'status_aktif',
		'dibuat_pada',
		'diperbarui_pada'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        'status_aktif' => 'boolean',
		'dibuat_pada' => 'datetime',
		'diperbarui_pada' => 'datetime'
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_pengguna', 'id_pengguna');
    }

    public function returs()
    {
        return $this->hasMany(Retur::class, 'id_pengguna', 'id_pengguna');
    }

    public function riwayatStoks()
    {
        return $this->hasMany(RiwayatStok::class, 'id_pengguna', 'id_pengguna');
    }

    public function notifikasiStoks()
    {
        return $this->hasMany(NotifikasiStok::class, 'id_penerima', 'id_pengguna');
    }

    public function biayaOperasionals()
    {
        return $this->hasMany(BiayaOperasional::class, 'id_pengguna', 'id_pengguna');
    }

    // @enddbml-sync:relations
}