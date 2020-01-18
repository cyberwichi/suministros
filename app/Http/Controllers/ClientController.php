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
}
