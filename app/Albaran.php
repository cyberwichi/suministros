<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Albaran extends Model
{
    protected $fillable = ['aviso_id', 'firma', 'observaciones'];
    protected $with = ['aviso', 'detallealbarans'];
    
    public function aviso()
    {
        return $this->belongsTo('App\Aviso');
    }
    public function detallealbarans()
    {
        return $this->hasMany('App\DetalleAlbaran');
    }

}
