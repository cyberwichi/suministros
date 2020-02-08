<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['nombre', 'email', 'direccion', 'telefono', 'cif'];
    protected $with = ['contrato'];

    public function contrato()
    {
        return $this->hasMany(Contrato::class);
    }
    public function aviso()
    {
        return $this->hasMany(Aviso::class);
    }
    
}

