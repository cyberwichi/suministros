<?php

namespace App\Http\Controllers;

use App\Albaran;
use App\DetalleAlbaran;
use Illuminate\Http\Request;

class AlbaranController extends Controller
{
    public function store(Request $request)
    {
        $albaran = new Albaran();
        $albaran->aviso_id = $request->aviso_id;
        $albaran->firma_cliente = $request->firma;
        $albaran->observaciones = $request->observaciones;
        $albaran->save();
        foreach ($request->detallealbaran as $key => $value) {
            $detalle = new DetalleAlbaran();
            $detalle->albaran_id = $albaran->id;
            $detalle->article_id = $value['articulo_id'];
            $detalle->cantidad=$value['cantidad'];
            $detalle->precio= $value['precio'];
            $detalle->save();
        }
        return $albaran->id;
    }
    public function index() {
        $albaranes = Albaran::get();
        return $albaranes;
    }
}
