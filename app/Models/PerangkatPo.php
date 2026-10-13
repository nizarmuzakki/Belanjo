<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerangkatPo extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'kode_perangkat',
		'nama_perangkat',
		'status_aktif',
		'terakhir_sinkron',
		'dibuat_pada'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        'status_aktif' => 'boolean',
		'terakhir_sinkron' => 'datetime',
		'dibuat_pada' => 'datetime'
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function logSinkronisasis()
    {
        return $this->hasMany(LogSinkronisasi::class, 'id_perangkat', 'id_perangkat');
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_perangkat', 'id_perangkat');
    }

    // @enddbml-sync:relations
}