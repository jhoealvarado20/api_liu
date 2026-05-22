<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'monto',     // Cambiado de 'monto_solicitado'
        'cuotas',    // Cambiado de 'plazo'
        'estado'
    ];
    // El crédito pertenece a un cliente
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Un crédito puede tener muchos pagos
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}