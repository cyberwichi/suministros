<?php

namespace App\Http\Controllers;

use App\DetalleAviso;
use Illuminate\Http\Request;

class DetalleAvisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->detalleaviso as $key=>$linea){
            $detalle = new DetalleAviso();
            $detalle->aviso_id= $request->aviso_id;
            $detalle->articulo_id = $linea['id'];
            $detalle->cantidad = $linea['cantidad'];
            $detalle->precio = $linea['precio'];
            $detalle->save();
            return 'Ok';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DetalleAviso  $detalleAviso
     * @return \Illuminate\Http\Response
     */
    public function show(DetalleAviso $detalleAviso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DetalleAviso  $detalleAviso
     * @return \Illuminate\Http\Response
     */
    public function edit(DetalleAviso $detalleAviso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DetalleAviso  $detalleAviso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleAviso $detalleAviso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DetalleAviso  $detalleAviso
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetalleAviso $detalleAviso)
    {
        //
    }
}
