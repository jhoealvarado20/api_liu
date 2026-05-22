<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\ClientController;
use App\Http\Controllers\API\v1\CreditController;

// 1. Ruta Pública para el Login (Aquí apunta Postman en el Paso 1)
Route::post('/login', [AuthController::class, 'login']);

// 2. Rutas Protegidas por Sanctum (Solo entran los que tienen Token válido)
Route::middleware('auth:sanctum')->group(function () {
    
    // Ruta que ya venía por defecto
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Tus nuevos endpoints de la API v1
    Route::apiResource('v1/clients', ClientController::class);
    Route::apiResource('v1/credits', CreditController::class);
    // Nuevas rutas para Créditos
    Route::get('v1/credits', [CreditController::class, 'index']);
    Route::get('v1/credits/{id}', [CreditController::class, 'show']);
    Route::post('v1/credits', [CreditController::class, 'store']);
});