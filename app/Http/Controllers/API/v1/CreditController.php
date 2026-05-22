<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\v1\StoreCreditRequest; // Importas tu Form Request
use App\Services\API\v1\CreditService; // Importas tu nuevo servicio

class CreditController extends Controller
{
    protected CreditService $creditService;
    // Inyectamos el servicio en el constructor
    public function __construct(CreditService $creditService)
    {
        $this->creditService = $creditService;
    }
    // GET: Listar todos los créditos
    public function index()
    {
        // Trae todos los créditos incluyendo los detalles de su cliente
        $credits = \App\Models\Credit::with('client')->get();
        return response()->json($credits, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCreditRequest $request)
    {
        // Los datos ya pasaron las validaciones de tipo de datos del Form Request
        $validatedData = $request->validated();

        // Delegamos TODA la lógica de negocio al servicio
        $credit = $this->creditService->registrarCredito($validatedData);

        return response()->json([
            'message' => 'Crédito procesado y registrado con éxito.',
            'data' => $credit
        ], 201);
    }
    
    // GET: Mostrar un crédito específico por ID
    public function show(string $id)
    {
        // Busca el crédito por su ID cargando su cliente
        $credit = \App\Models\Credit::with('client')->find($id);
        if (!$credit) {
            return response()->json([
                'message' => 'Crédito no encontrado.'
            ], 404);
        }
        return response()->json($credit, 200);
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
