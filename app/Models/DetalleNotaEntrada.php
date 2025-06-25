<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleNotaEntrada extends Model
{
    use HasFactory;

    public $incrementing = false;  // No hay campo auto-incremental
    protected $primaryKey = null;  // No hay clave primaria tradicional
    protected $fillable = [
        'nota_entrada_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
