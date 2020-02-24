<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['article_id', 'proveedor_id', 'cantidad', 'comentario'];
    protected $with = ['proveedor', 'article'];

    public function proveedor()
    {
        return $this->belongsTo('App\Proveedor');
    }
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
