<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // @dbml-sync:table-property apake
    protected $table = 'kategori';
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'nama_kategori',
		'deskripsi'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function produks()
    {
        return $this->hasMany(Produk::class, 'id_kategori', 'id_kategori');
    }

    // @enddbml-sync:relations
}