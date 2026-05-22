<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Trae todos los clientes registrados en la base de datos
        $clients = Client::all();

        // Los retorna formateados como JSON automáticamente
        return response()->json($clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Aquí se ejecuta la Validación en el Controlador
        $dataValidaded = $request->validate([
            'nombre'            => 'required|string|max:255',
            'email'             => 'required|email|unique:clients,email',
            'tipo_documento'    => 'required|string|in:DNI,RUC,CE',
            'numero_documento'  => 'required|string|unique:clients,numero_documento',
            'direccion'         => 'nullable|string|max:500',
            'telefono'          => 'nullable|string|max:20',
        ]);

        // 2. Si pasa la validación, se crea el registro con los datos limpios
        $client = Client::create($dataValidaded);

        return response()->json([
            'message' => 'Cliente creado con éxito',
            'data' => $client
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
