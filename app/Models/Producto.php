<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'foto',
        'codigo',
        'stock',
        'categoria_id',
        'almacen_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function almacen()
    {
        return $this->belongsTo(Almacen::class);
    }
}
