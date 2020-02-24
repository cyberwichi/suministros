<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function aviso()
    {
        return $this->hasMany(Aviso::class);
    }
}
