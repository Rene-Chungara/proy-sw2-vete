<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class BiDashboardController extends Controller
{
    // Mostrar dashboard
    public function index()
    {
        $bi = DB::table('bi_resultados')
            ->join('productos', 'bi_resultados.producto_id', '=', 'productos.id')
            ->select(
                'productos.nombre as producto',
                'productos.stock',
                'bi_resultados.eoq',
                'bi_resultados.rop',
                'bi_resultados.clasificacion_abc'
            )
            ->get();

        // Datos para gráfico ABC
        $abcChart = [
            'A' => $bi->where('clasificacion_abc', 'A')->count(),
            'B' => $bi->where('clasificacion_abc', 'B')->count(),
            'C' => $bi->where('clasificacion_abc', 'C')->count(),
        ];

        return view('bi.dashboard', compact('bi', 'abcChart'));
    }

    // Llama al microservicio Python
    public function actualizar()
    {
        try {      //https://proy-micro-sw2-production.up.railway.app //Link del backend
            $response = Http::get('http://127.0.0.1:8001/api/bi/inventario');
            if ($response->successful()) {
                return redirect()->route('bi.dashboard')->with('success', 'Datos actualizados correctamente.');
            } else {
                return back()->with('error', 'Error al actualizar: ' . $response->status());
            }
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo conectar al microservicio: ' . $e->getMessage());
        }
    }
}
