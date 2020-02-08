<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleAlbaran extends Model
{
    protected $fillable = ['albaran_id', 'article_id', 'cantidad', 'precio'];
    protected $with = ['article'];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }
    public function albaran()
    {
        return $this->belongsTo('App\Albaran');
    }
}
