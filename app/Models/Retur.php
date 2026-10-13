<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'retur';
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'id_transaksi',
		'id_produk',
		'jumlah',
		'alasan',
		'tanggal_retur',
		'id_pengguna'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        'tanggal_retur' => 'datetime'
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
    }

    public function riwayatStoks()
    {
        return $this->hasMany(RiwayatStok::class, 'id_retur', 'id_retur');
    }

    // @enddbml-sync:relations
}