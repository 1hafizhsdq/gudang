<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transaksiDetail(){
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id', 'id');
    }
    
    public function project(){
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function client(){
        return $this->belongsTo(Client::class, 'client_id');
    }
}
