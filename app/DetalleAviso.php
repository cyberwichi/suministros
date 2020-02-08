<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleAviso extends Model
{
    protected $with = ['article'];
    public function aviso()
    {
        return $this->belongsTo(Aviso::class);
    }
    public function article()
    {
        return $this->belongsTo(Article::class, 'articulo_id', 'id');
    }
}
