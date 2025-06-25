<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Producto;


class PrediccionController extends Controller
{
    //
    public function seleccionarProducto()
    {
        $productos = Producto::all();
        return view('bi.seleccionar_producto', compact('productos'));
    }

    public function mostrarPrediccion($id)
    {
        $producto = Producto::findOrFail($id);

        $response = Http::get('https://proy-micro-sw2-production.up.railway.app/api/prediccion', [
            'producto_id' => $id
        ]);

        $datos = $response->successful() ? $response->json() : ['message' => 'Error al obtener predicción'];

        return view('bi.prediccion', compact('datos', 'producto'));
    }
}
