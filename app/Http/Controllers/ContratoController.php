<?php

namespace App\Http\Controllers;

use App\Albaran;
use App\Contrato;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contratos=Contrato::with('client')->with('aviso')->get();
        return $contratos;
    }
    public function index2($id)
    {
        $contrato=Contrato::where('id', $id)->with('aviso')->get();
        return $contrato;
    }
    public function movimientos($id)
    {
        $contrato=Contrato::where('id', $id)->with('aviso')->first(); 
        $avisos=[];
        foreach ($contrato->aviso as $key=>$value) {           
            $albaranes= Albaran::where('aviso_id', $value->id)->get();
            $avisos[$key]=$albaranes;
        }        
        return $avisos;
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
        $contrato= new Contrato();
        $contrato->client_id=$request->client_id;
        $contrato->importe=$request->importe;
        $contrato->comentario=$request->comentario;
        $contrato->saldo=$request->importe;
        $contrato->save();
        return $contrato;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $contratos=Contrato::where('client_id', $id)->get();
       return $contratos;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function edit(Contrato $contrato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $contrato)
    {
        $cont= Contrato::find($contrato);
        $cont->importe=$request->importe;
        $cont->comentario=$request->comentario;
        $cont->save();
        return 'ok';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contrato=Contrato::where('id', $id)->delete();
        return "ok";
    }
}
