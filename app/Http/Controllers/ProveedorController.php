<?php

namespace App\Http\Controllers;

use App\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::get();
        return $proveedores;
    }
    public function new(Request $request)
    {
        $proveedor=new Proveedor();
        $proveedor->nombre=$request->nombre;
        $proveedor->cif = $request->cif;
        $proveedor->telefono = $request->telefono;
        $proveedor->direccion = $request->direccion;
        $proveedor->email = $request->email;
        $proveedor->comentario = $request->comentario;
        $proveedor->save();
        return $proveedor;
    }
    public function update($id, Request $request)
    {
        $proveedor=Proveedor::find($id);        
        $proveedor->nombre = $request->nombre;
        $proveedor->cif = $request->cif;
        $proveedor->telefono = $request->telefono;
        $proveedor->direccion = $request->direccion;
        $proveedor->email = $request->email;
        $proveedor->comentario = $request->comentario;
        $proveedor->save();
        return 'ok';
    }
    public function delete($id)
    {
        $proveedor= Proveedor::find($id);
        $proveedor->delete();
        return 'ok';
    }
    public function searchproveedor($dd)
    {
        $proveedor = Proveedor::where('nombre', 'LIKE', '%' . $dd . '%')->get();
        return $proveedor;
    }
    public function porid($id)
    {
        $proveedor=Proveedor::find($id)->get();
        return $proveedor;
    }


}
