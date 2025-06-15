<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'nota_venta_id',
        'producto_id',
        'cantidad',
        'precio_venta',
        'importe',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
