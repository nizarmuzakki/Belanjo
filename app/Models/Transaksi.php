<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'transaksi';
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'kode_transaksi',
		'id_pelanggan',
		'id_pengguna',
		'id_perangkat',
		'id_log_sinkronisasi',
		'tanggal_transaksi',
		'status',
		'saluran',
		'status_sinkronisasi',
		'subtotal',
		'diskon',
		'pajak',
		'total_bayar',
		'waktu_sinkronisasi',
		'dibuat_pada'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        'tanggal_transaksi' => 'datetime',
		'waktu_sinkronisasi' => 'datetime',
		'dibuat_pada' => 'datetime'
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
    }

    public function perangkatPo()
    {
        return $this->belongsTo(PerangkatPo::class, 'id_perangkat', 'id_perangkat');
    }

    public function logSinkronisasi()
    {
        return $this->belongsTo(LogSinkronisasi::class, 'id_log_sinkronisasi', 'id_log');
    }

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi', 'id_transaksi');
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'id_transaksi', 'id_transaksi');
    }

    public function returs()
    {
        return $this->hasMany(Retur::class, 'id_transaksi', 'id_transaksi');
    }

    public function riwayatStoks()
    {
        return $this->hasMany(RiwayatStok::class, 'id_transaksi', 'id_transaksi');
    }

    // @enddbml-sync:relations
}