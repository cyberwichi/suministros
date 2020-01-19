<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['nombre', 'email', 'direccion', 'telefono', 'cif'];
    
    public function contrato()
    {
        return $this->hasMany(Contrato::class);
    }
}

