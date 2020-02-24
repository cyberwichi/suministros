<?php

namespace App\Http\Controllers;

use App\Article;
use App\Aviso;
use App\DetalleAviso;
use Illuminate\Http\Request;

class AvisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $avisos = Aviso::with('albarans')->get();
        return $avisos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $aviso = new Aviso();
        $aviso->client_id = $request->client_id;
        $aviso->comentario = $request->comentario;
        if ($request->contrato_id) {
            $aviso->contrato_id = $request->contrato_id;
        } else {
            $aviso->contrato_id = 0;
        }
        $aviso->terminado = false;
        $aviso->save();
        foreach ($request->detalleaviso as $key => $value) {
            $det = new DetalleAviso();
            $det->articulo_id = $value['id'];
            $det->aviso_id = $aviso->id;
            $det->cantidad = $value['cantidad'];
            $det->precio = $value['precio'];
            $det->save();
            $articulo = Article::find($value['id']);
            $articulo->stockvendido += $value['cantidad'];
            $articulo->save();
        }
        return 'Ok';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aviso = Aviso::find($id);
        return $aviso;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function edit(Aviso $aviso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $aviso = Aviso::find($id);
        $aviso->client_id = $request->client_id;
        $aviso->comentario = $request->comentario;
        if ($request->contrato_id) {
            $aviso->contrato_id = $request->contrato_id;
        } else {
            $aviso->contrato_id = 0;
        }
        $aviso->terminado = $request->terminado;
        $aviso->save();
        DetalleAviso::where('aviso_id', $id)->delete();
        foreach ($request->detalleaviso as $key => $value) {
            $det = new DetalleAviso();
            $det->articulo_id = $value['articulo_id'];
            $det->aviso_id = $value['aviso_id'];
            $det->cantidad = $value['cantidad'];
            $det->precio = $value['precio'];
            $det->save();
        }
        $avisos = Aviso::get();
        Article::where('stockvendido', '>', 0)->update(['stockvendido' => 0]);

        foreach ($avisos as $key => $value) {
            foreach ($value->detalleaviso as $key2 => $value2) {
                $articulo = Article::find($value2->articulo_id);
                $articulo->stockvendido += $value2->cantidad;
                $articulo->save();
            }            
        }


        return 'Ok';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aviso = Aviso::destroy($id);
        $detalleaviso = DetalleAviso::where('aviso_id', $id)->delete();
        $avisos = Aviso::get();
        Article::where('stockvendido', '>', 0)->update(['stockvendido' => 0]);
        foreach ($avisos as $key => $value) {
            foreach ($value->detalleaviso as $key2 => $value2) {
                $articulo = Article::find($value2->articulo_id);
                $articulo->stockvendido += $value2->cantidad;
                $articulo->save();
            }
        }
        return 'Ok';
    }
}
