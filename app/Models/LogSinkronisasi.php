<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogSinkronisasi extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'log_sinkronisasi';
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'id_perangkat',
		'waktu_mulai',
		'waktu_selesai',
		'status',
		'jumlah_data_dikirim',
		'jumlah_data_berhasil',
		'jumlah_percobaan',
		'pesan_kesalahan'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        'waktu_mulai' => 'datetime',
		'waktu_selesai' => 'datetime'
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function perangkatPo()
    {
        return $this->belongsTo(PerangkatPo::class, 'id_perangkat', 'id_perangkat');
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_log_sinkronisasi', 'id_log');
    }

    // @enddbml-sync:relations
}