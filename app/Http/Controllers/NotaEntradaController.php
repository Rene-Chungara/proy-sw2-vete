<?php

namespace App\Http\Controllers;

use App\Models\NotaEntrada;
use App\Models\DetalleNotaEntrada;
use App\Models\Proveedor;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotaEntradaController extends Controller
{
    public function index()
    {
        $nota_entradas = NotaEntrada::with('proveedor')->paginate(10);
        return view('nota_entradas.index', compact('nota_entradas'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        return view('nota_entradas.form', compact('proveedores', 'productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'monto' => 'required|numeric|min:0',
            'proveedor_id' => 'required|exists:proveedors,id',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $nota = NotaEntrada::create([
                'fecha' => $request->fecha,
                'monto' => $request->monto,
                'descripcion' => $request->descripcion,
                'proveedor_id' => $request->proveedor_id,
            ]);

            foreach ($request->productos as $detalle) {
                DetalleNotaEntrada::create([
                    'nota_entrada_id' => $nota->id,
                    'producto_id' => $detalle['producto_id'],
                    'cantidad' => $detalle['cantidad'],
                    'precio_unitario' => $detalle['precio_unitario'],
                    'subtotal' => $detalle['cantidad'] * $detalle['precio_unitario'],
                ]);

                // Aumenta el stock
                $producto = Producto::find($detalle['producto_id']);
                $producto->stock += $detalle['cantidad'];
                $producto->save();
            }
        });

        return redirect()->route('nota_entradas.index')->with('success', 'Nota de entrada creada con éxito.');
    }
    
    public function show(NotaEntrada $nota_entrada)
    {
        $nota_entrada->load(['proveedor', 'detalles.producto']);
        return view('nota_entradas.show', compact('nota_entrada'));
    }
    public function destroy(NotaEntrada $nota_entrada)
    {
        // Opcional: puedes revertir el stock si lo deseas
        foreach ($nota_entrada->detalles as $detalle) {
            $detalle->producto->decrement('stock', $detalle->cantidad);
        }

        $nota_entrada->delete();

        return redirect()->route('nota_entradas.index')->with('success', 'Nota de entrada eliminada con éxito.');
    }
}
