<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaEntrada extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'monto',
        'descripcion',
        'proveedor_id',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleNotaEntrada::class);
    }
}
