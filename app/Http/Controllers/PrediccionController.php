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

        $response = Http::get('http://localhost:3000/api/prediccion', [
            'producto_id' => $id
        ]);

        $datos = $response->successful()
            ? $response->json()
            : ['message' => 'No se pudo obtener la predicción'];

        return view('bi.prediccion', compact('datos', 'producto'));
    }


    public function mostrarRecomendacionCompra($id)
    {
        $producto = Producto::findOrFail($id);
        $response = Http::timeout(20)->get('http://localhost:3000/api/recomendaciones/compras', [
            'producto_id' => $id
        ]);
        $datos = $response->successful() ? $response->json() : ['message' => 'Error al obtener recomendación de compra'];
        return view('bi.recomendaciones_compras', compact('datos', 'producto'));
    }

    public function mostrarSugerenciasPrecio(Request $request)
    {
        $response = Http::timeout(10)->get('http://localhost:3000/api/pricing/sugerencias');

        $datos = $response->successful()
            ? $response->json()
            : ['sugerencias' => [], 'error' => 'No se pudo obtener sugerencias'];

        $sugerencias = collect($datos['sugerencias'] ?? []);

        // Filtro por nombre de producto si hay búsqueda
        if ($request->has('search')) {
            $search = strtolower($request->input('search'));
            $sugerencias = $sugerencias->filter(function ($item) use ($search) {
                return str_contains(strtolower($item['nombre']), $search);
            })->values();
        }

        return view('bi.sugerencias_precio', [
            'sugerencias' => $sugerencias,
            'search' => $request->input('search')
        ]);
    }

    public function mostrarSegmentacionProductos(Request $request)
    {
        $response = Http::timeout(10)->get('http://localhost:3000/api/segmentacion-productos');

        $productos = $response->successful()
            ? collect($response->json() ?? [])
            : collect();

        if ($request->has('search')) {
            $search = strtolower($request->input('search'));
            $productos = $productos->filter(fn($p) => str_contains(strtolower($p['nombre']), $search))->values();
        }

        // Filtro por categoría
        if ($request->filled('categoria')) {
            $productos = $productos->where('categoria_rotacion', $request->input('categoria'))->values();
        }

        return view('bi.segmentacion_productos', [
            'productos' => $productos,
            'search' => $request->input('search'),
            'categoria' => $request->input('categoria'),
        ]);
    }

    public function mostrarClasificacionProveedores(Request $request)
    {
        $response = Http::timeout(10)->get('http://localhost:3000/api/clasificacion-proveedores');

        $proveedores = $response->successful()
            ? collect($response->json() ?? [])
            : collect();

        if ($request->has('search')) {
            $search = strtolower($request->input('search'));
            $proveedores = $proveedores->filter(fn($p) => str_contains(strtolower($p['nombre']), $search))->values();
        }

        // Filtro por desempeño
        if ($request->filled('desempeno')) {
            $proveedores = $proveedores->where('desempeno', $request->input('desempeno'))->values();
        }

        return view('bi.clasificacion_proveedores', [
            'proveedores' => $proveedores,
            'search' => $request->input('search'),
            'desempeno' => $request->input('desempeno'),

        ]);
    }
}
