<?php

namespace App\Http\Controllers;

use App\Models\NotaSalida;
use App\Models\DetalleNotaSalida;
use App\Models\Proveedor;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotaSalidaController extends Controller
{
    public function index()
    {
        $nota_salidas = NotaSalida::with('proveedor')->paginate(10);
        return view('nota_salidas.index', compact('nota_salidas'));
    }

    public function create()
    {
        $proveedores = \App\Models\Proveedor::all();
        $productos = \App\Models\Producto::all();
        return view('nota_salidas.form', compact('proveedores', 'productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'monto' => 'required|numeric|min:0',
            'descripcion' => 'required|string',
            'proveedor_id' => 'required|exists:proveedors,id',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Validar stock suficiente
                foreach ($request->productos as $detalle) {
                    $producto = Producto::find($detalle['producto_id']);
                    if ($producto->stock < $detalle['cantidad']) {
                        throw new \Exception("Stock insuficiente para el producto: {$producto->nombre}");
                    }
                }

                // Crear nota de salida
                $nota = NotaSalida::create([
                    'fecha' => $request->fecha,
                    'monto' => $request->monto,
                    'descripcion' => $request->descripcion,
                    'proveedor_id' => $request->proveedor_id,
                ]);

                // Crear detalle y disminuir stock
                foreach ($request->productos as $detalle) {
                    DetalleNotaSalida::create([
                        'nota_salida_id' => $nota->id,
                        'producto_id' => $detalle['producto_id'],
                        'cantidad' => $detalle['cantidad'],
                        'precio_unitario' => $detalle['precio_unitario'],
                        'subtotal' => $detalle['cantidad'] * $detalle['precio_unitario'],
                    ]);

                    $producto = Producto::find($detalle['producto_id']);
                    $producto->stock -= $detalle['cantidad'];
                    $producto->save();
                }
            });

            return redirect()->route('nota_salidas.index')->with('success', 'Nota de salida registrada con éxito.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function show(NotaSalida $nota_salida)
    {
        $nota_salida->load(['proveedor', 'detalles.producto']);
        return view('nota_salidas.show', compact('nota_salida'));
    }

    public function destroy(NotaSalida $nota_salida)
    {
        DB::transaction(function () use ($nota_salida) {
            // Devolver el stock
            foreach ($nota_salida->detalles as $detalle) {
                $detalle->producto->increment('stock', $detalle->cantidad);
            }

            $nota_salida->delete();
        });

        return redirect()->route('nota_salidas.index')->with('success', 'Nota de salida eliminada con éxito.');
    }
}
