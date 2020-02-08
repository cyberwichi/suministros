<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Article extends Model
{
    protected $fillable = ['nombre', 'nserie', 'descripcion', 'precio', 'stock', 'stockvendido', 'stockcomprado'];
    protected $with= ['proveedorarticle'];

    public function proveedorarticle()
    {
        return $this->hasMany('App\Proveedorarticle');
    }
    public function detalleaviso()
    {
        return $this->hasMany(DetalleAviso::class, 'id', 'articulo_id');
    }
}
