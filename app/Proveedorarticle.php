<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedorarticle extends Model
{
    protected $fillable = ['article_id', 'proveedor_id', 'coste' ];
    
    protected $with = ['proveedor'];
    public function proveedor() 
    {
        return $this->belongsTo(Proveedor::class);
    }
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
