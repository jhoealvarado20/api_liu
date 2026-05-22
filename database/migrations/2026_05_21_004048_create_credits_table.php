<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('credits', function (Blueprint $blueprint) {
            $blueprint->id();
            // Llave foránea que conecta con la tabla de clientes
            $blueprint->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $blueprint->decimal('monto', 10, 2);
            $blueprint->integer('cuotas');
            $blueprint->string('estado')->default('pendiente'); // pendiente, pagado, vencido
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credits');
    }
};
