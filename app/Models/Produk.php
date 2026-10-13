<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'produk';
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'id_kategori',
		'kode_sku',
		'nama_produk',
		'deskripsi',
		'harga_pokok',
		'harga_jual',
		'satuan',
		'jumlah_stok',
		'stok_minimum',
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
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_produk', 'id_produk');
    }

    public function returs()
    {
        return $this->hasMany(Retur::class, 'id_produk', 'id_produk');
    }

    public function riwayatStoks()
    {
        return $this->hasMany(RiwayatStok::class, 'id_produk', 'id_produk');
    }

    public function notifikasiStoks()
    {
        return $this->hasMany(NotifikasiStok::class, 'id_produk', 'id_produk');
    }

    // @enddbml-sync:relations
}