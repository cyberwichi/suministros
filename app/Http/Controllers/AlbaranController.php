<?php

namespace App\Http\Controllers;

use App\Albaran;
use App\Contrato;
use App\DetalleAlbaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\App;

class AlbaranController extends Controller
{
    public function store(Request $request)
    {
        $albaran = new Albaran();
        $albaran->aviso_id = $request->aviso_id;
        $albaran->firma_cliente = $request->firma;
        $albaran->observaciones = $request->observaciones;
        $albaran->save();
        $acumula = 0;
        foreach ($request->detallealbaran as $key => $value) {
            $detalle = new DetalleAlbaran();
            $detalle->albaran_id = $albaran->id;
            $detalle->article_id = $value['articulo_id'];
            $detalle->cantidad = $value['cantidad'];
            $detalle->precio = $value['precio'];
            $detalle->save();
            $acumula += $detalle->cantidad * $detalle->precio;
        }
        $contrato = Contrato::find($albaran->aviso->contrato_id);
        $contrato->saldo -= $acumula;
        $contrato->save();
        return $albaran->id;
        
    }
    public function index()
    {
        
        $albaranes = Albaran::get();
        /* foreach ($albaranes as $key => $value) {
            $acumula= 0;
            foreach ($value->detallealbarans as $key => $detalle) {                
                $acumula += $detalle->cantidad * $detalle->precio;
            }
            $contrato = Contrato::find($value->aviso->contrato_id);
            $contrato->saldo -= $acumula;
            $contrato->save();
        } */
        return $albaranes;

    }
    public function creapdf($id)
    {
        $albaran = Albaran::find($id);
        $pdf = PDF::loadView('pdf/pdf', compact('albaran'));
        $pdf->save('albaranes/albaran' . $id . '.pdf');
        return $id;
    }
}
