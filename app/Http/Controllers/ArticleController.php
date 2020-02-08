<?php

namespace App\Http\Controllers;

use App\Article;
use App\Proveedorarticle;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articulos = Article::get();
        return $articulos;
    }
    public function delete($id)
    {
        $articulo=Article::find($id);
        $articulo->delete();
        $proveearticulo = Proveedorarticle::where('article_id', $id)->delete(); 
        return 'ok';
    }
    public function update(Request $request, $id)
    {
        $articulo=Article::find($id);
        $articulo->nombre= $request->nombre;
        $articulo->nserie = $request->nserie;
        $articulo->descripcion = $request->descripcion;
        $articulo->precio = $request->precio;
        $articulo->stock = $request->stock;
        $articulo->stockvendido = $request->stockvendido;
        $articulo->stockcomprado = $request->stockcomprado;
        $articulo->save();
        return "ok";
    }
    public function new(Request $request)
    {        
        $articulo= new Article();
        $articulo->nombre = $request->nombre;
        $articulo->nserie = $request->nserie;
        $articulo->descripcion = $request->descripcion;
        $articulo->precio = $request->precio;
        $articulo->stock = $request->stock;
        $articulo->stockvendido = $request->stockvendido;
        $articulo->stockcomprado = $request->stockcomprado;
        $articulo->save();
        return $articulo;
    }
    public function searcharticulo($dd)
    {
        $contactos = Article::where('nombre', 'LIKE', '%' . $dd . '%')->get();
        return $contactos;
    }
}
