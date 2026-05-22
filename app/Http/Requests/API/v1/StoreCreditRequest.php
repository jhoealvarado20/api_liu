<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCreditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Cambiar a true para permitir que cualquier usuario validado use este Request    
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'client_id' => 'required|exists:clients,id',
        'monto'     => 'required|numeric|min:1',
        'cuotas'    => 'required|integer|min:1',
        'estado'    => 'nullable|string|in:pendiente,aprobado,rechazado,pagado'
    ];
    }
    /**
     * Personalizar los mensajes de error (Opcional).
     */
    public function messages(): array
    {
        return [
            'client_id.exists'     => 'El cliente seleccionado no existe en nuestra base de datos.',
            'monto_solicitado.max' => 'El monto máximo para una solicitud es de S/ 1,000,000.',
        ];
    }
}
