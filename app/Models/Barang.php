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

    public function sku()
    {
        return $this->hasMany(Sku::class);
    }

    public function merk(){
        return $this->belongsTo(Merk::class, 'merk_id');
    }

    public function type(){
        return $this->belongsTo(Type::class, 'type_id');
    }
}
