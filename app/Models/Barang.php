<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
