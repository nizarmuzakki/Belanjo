<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifikasiStok extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'notifikasi_stok';
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'id_produk',
		'id_penerima',
		'jenis',
		'pesan',
		'sudah_dibaca',
		'dibuat_pada'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        'sudah_dibaca' => 'boolean',
		'dibuat_pada' => 'datetime'
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_penerima', 'id_pengguna');
    }

    // @enddbml-sync:relations
}