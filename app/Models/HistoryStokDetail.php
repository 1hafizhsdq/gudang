<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryStokDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function sku()
    {
        return $this->belongsTo(Sku::class, 'sku_id');
    }
}
