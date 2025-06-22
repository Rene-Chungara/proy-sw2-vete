<?php

namespace App\Http\Controllers;

use App\Models\NotaVenta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\TipoPago;
use App\Models\DetalleNotaEntrada;
use App\Models\DetalleNotaSalida;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVentas = NotaVenta::sum('monto');
        $cantidadVendida = DetalleVenta::sum('cantidad');
        $movimientos = DetalleNotaEntrada::count() + DetalleNotaSalida::count();
        $stockBajo = Producto::where('stock', '<', 5)->count();

        $ventasDia = NotaVenta::selectRaw("to_char(fecha, 'YYYY-MM-DD') as dia, SUM(monto) as total")
            ->where('fecha', '>=', now()->subDays(30))
            ->groupBy('dia')
            ->orderBy('dia')
            ->get();

        $movimientosProducto = DetalleNotaEntrada::select('producto_id', DB::raw('SUM(cantidad) as cantidad'))
            ->groupBy('producto_id')
            ->with('producto')
            ->get();

        $productosTop = DetalleVenta::select('producto_id', DB::raw('SUM(cantidad) as total'))
            ->groupBy('producto_id')
            ->with('producto')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $tipoPago = NotaVenta::select('tipo_pago_id', DB::raw('SUM(monto) as total'))
            ->groupBy('tipo_pago_id')
            ->with('tipoPago')
            ->get();

        return view('dashboard.reporte', compact(
            'totalVentas', 'cantidadVendida', 'movimientos', 'stockBajo',
            'ventasDia', 'movimientosProducto', 'productosTop', 'tipoPago'
        ));
    }
}
