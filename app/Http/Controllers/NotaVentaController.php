<?php

namespace App\Http\Controllers;

use App\Models\NotaVenta;
use App\Models\DetalleVenta;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\TipoPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotaVentaController extends Controller
{
    public function index()
    {
        $nota_ventas = NotaVenta::with('cliente', 'usuario', 'tipoPago')->paginate(10);
        return view('nota_ventas.index', compact('nota_ventas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        $tipos_pago = TipoPago::all();
        return view('nota_ventas.form', compact('clientes', 'productos', 'tipos_pago'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'monto' => 'required|numeric|min:0',
            'cliente_id' => 'required|exists:clientes,id',
            'tipo_pago_id' => 'required|exists:tipo_pagos,id',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio_venta' => 'required|numeric|min:0',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Validar stock antes de descontar
                foreach ($request->productos as $detalle) {
                    $producto = Producto::find($detalle['producto_id']);
                    if ($producto->stock < $detalle['cantidad']) {
                        throw new \Exception("Stock insuficiente para el producto: {$producto->nombre}");
                    }
                }

                // Crear la venta
                $nota = NotaVenta::create([
                    'fecha' => $request->fecha,
                    'monto' => $request->monto,
                    'cliente_id' => $request->cliente_id,
                    'usuario_id' => auth()->id(),
                    'tipo_pago_id' => $request->tipo_pago_id,
                ]);

                // Guardar detalles y actualizar stock
                foreach ($request->productos as $detalle) {
                    DetalleVenta::create([
                        'nota_venta_id' => $nota->id,
                        'producto_id' => $detalle['producto_id'],
                        'cantidad' => $detalle['cantidad'],
                        'precio_venta' => $detalle['precio_venta'],
                        'importe' => $detalle['cantidad'] * $detalle['precio_venta'],
                    ]);

                    $producto = Producto::find($detalle['producto_id']);
                    $producto->stock -= $detalle['cantidad'];
                    $producto->save();
                }
            });

            return redirect()->route('nota_ventas.index')->with('success', 'Venta registrada con éxito.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function show(NotaVenta $nota_venta)
    {
        $nota_venta->load(['cliente', 'usuario', 'tipoPago', 'detalles.producto']);
        return view('nota_ventas.show', compact('nota_venta'));
    }

    public function destroy(NotaVenta $nota_venta)
    {
        foreach ($nota_venta->detalles as $detalle) {
            $detalle->producto->increment('stock', $detalle->cantidad);
        }

        $nota_venta->delete();

        return redirect()->route('nota_ventas.index')->with('success', 'Venta eliminada con éxito.');
    }
}
