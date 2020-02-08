<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aviso extends Model
{
    protected $fillable = ['client_id', 'comentario', 'contrato_id', 'terminado'];
    protected $with = ['client', 'contrato', 'detalleaviso'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }
    public function detalleaviso()
    {
        return $this->hasMany(DetalleAviso::class);
    }
}
