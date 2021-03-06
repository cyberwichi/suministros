<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::get();
        return $clients;
    }
    public function new(Request $request)
    {
        $client = new Client();
        $client->nombre = $request->nombre;
        $client->cif = $request->cif;
        $client->direccion = $request->direccion;
        $client->telefono = $request->telefono;
        $client->email = $request->email;
        $client->save();
        return $client;
    }
    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        $client->nombre = $request->nombre;
        $client->cif = $request->cif;
        $client->direccion = $request->direccion;
        $client->telefono = $request->telefono;
        $client->email = $request->email;
        $client->save();
        return 'ok';
    }
    public function delete($id)
    {
        $client = Client::find($id);
        $client->delete();
        return 'ok';
    }
    public function searchcontacto($dd)
    {
        $contactos = Client::where('nombre', 'LIKE', '%' . $dd . '%')->get();
        return $contactos;
    }
}
