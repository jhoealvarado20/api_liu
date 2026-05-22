<?php

namespace App\Services\API\v1;

use App\Models\Credit;
use Illuminate\Validation\ValidationException;

class CreditService
{
    /**
     * Evalúa y registra una solicitud de crédito.
     */
    public function registrarCredito(array $data)
    {
        // 1. Aplicar lógica de negocio: Verificar si el cliente ya tiene un crédito activo o pendiente
        $tieneCreditoActivo = Credit::where('client_id', $data['client_id'])
            ->whereIn('estado', ['pendiente', 'aprobado'])
            ->exists();

        if ($tieneCreditoActivo) {
            // Lanzamos una excepción de validación que Laravel captura automáticamente
            throw ValidationException::withMessages([
                'client_id' => ['El cliente ya cuenta con una solicitud de crédito activa o pendiente.'],
            ]);
        }

        // 2. Si pasa la regla de negocio, se registra en la base de datos
        return Credit::create($data);
    }
}