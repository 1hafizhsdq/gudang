<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function historyStokDetail()
    {
        return $this->hasMany(HistoryStokDetail::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
