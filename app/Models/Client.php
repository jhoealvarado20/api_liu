<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'email', 'tipo_documento', 'numero_documento', 'direccion', 'telefono'
    ];

    // Un cliente puede tener muchos créditos
    public function credits()
    {
        return $this->hasMany(Credit::class);
    }
}