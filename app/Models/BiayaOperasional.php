<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaOperasional extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'biaya_operasional';
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'kategori_biaya',
		'deskripsi',
		'jumlah',
		'tanggal_biaya',
		'id_pengguna'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        'tanggal_biaya' => 'date'
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
    }

    // @enddbml-sync:relations
}