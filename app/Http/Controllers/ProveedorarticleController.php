<?php

namespace App\Http\Controllers;

use App\Proveedorarticle;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;

class ProveedorarticleController extends Controller
{
    public function new($id, Request $request)
    {
        $aux = new Proveedorarticle();
        $aux->article_id = $id;
        $aux->proveedor_id = $request->proveedor_id; 
        $aux->coste = $request->coste;
        $aux->save();

        return 'Ok';
    }
    public function porarticulo($id)
    {
        $proveedors = Proveedorarticle::where('article_id', $id)->get();
        return $proveedors;
    }
    public function update($id)
    {
        $proveedors = Proveedorarticle::where('article_id', $id)->delete();
    }
    public function proveedorarticulo($prov, $id)
    {
        $coste = Proveedorarticle::where('proveedor_id', $prov)->where('article_id', $id)->get();
        return $coste;
    }
}
