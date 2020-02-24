<?php

namespace App\Http\Controllers;

use App\Article;
use App\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function  index()
    {
        $pedidos= Pedido::get();
        return $pedidos;
    }
    public function store(Request $request)
    {
        $pedido= new Pedido();
        $pedido->article_id= $request->article_id;
        $pedido->proveedor_id = $request->proveedor_id;
        $pedido->cantidad = $request->cantidad;
        $pedido->comentario = $request->comentario;
        $pedido->save();
        $articulo= Article::find($request->article_id);
        $articulo->stockcomprado +=  $request->cantidad;
        $articulo->save();
        $pedido= Pedido::find($pedido->id);
        return $pedido;
    }
    public function destroy($id)
    {
        $pedido = Pedido::find($id);
        $articulo = Article::find($pedido->article_id);
        $articulo->stockcomprado -=  $pedido->cantidad;
        $articulo->save();
        $pedido->delete();
        return $articulo;
    }
    public function recibe($id)
    {
        $pedido = Pedido::find($id);
        $articulo=Article::find($pedido->article_id);
        $articulo->stock += $pedido->cantidad;
        $articulo->stockcomprado -= $pedido->cantidad;
        $articulo->save();
        $pedido->delete();
        return 'Ok';
    }
}
