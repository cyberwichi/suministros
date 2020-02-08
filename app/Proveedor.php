<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $fillable = ['nombre', 'email', 'direccion', 'telefono', 'cif', 'comentario'];
 
    public function article()
    {
        return $this->hasMany(Article::class);
    }
    public function proveedorarticle()
    {
        return $this->hasMany(Proveedorarticle::class);
    }
}
