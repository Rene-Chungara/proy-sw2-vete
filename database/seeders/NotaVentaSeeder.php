<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NotaVenta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Categoria;
use Faker\Factory as Faker;
use Carbon\Carbon;

class NotaVentaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        
        // Obtener todos los productos y categorías una sola vez para optimizar
        $productos = \App\Models\Producto::all();
        $clientes = \App\Models\Cliente::pluck('id')->toArray();
        $usuarios = \App\Models\User::pluck('id')->toArray();
        $tiposPago = \App\Models\TipoPago::pluck('id')->toArray();
        
        // Fecha de inicio: 18 meses atrás
        $fechaInicio = Carbon::now()->subMonths(18);
        $fechaFin = Carbon::now();
        
        // Generar entre 800-1200 ventas para tener datos más robustos
        $totalVentas = rand(800, 1200);
        
        for ($i = 1; $i <= $totalVentas; $i++) {
            // Generar fecha con distribución más realista
            $fecha = $this->generarFechaRealista($faker, $fechaInicio, $fechaFin);
            
            // Determinar número de productos según día de la semana
            $diaSemana = $fecha->dayOfWeek;
            $numProductos = $this->determinarNumeroProductos($diaSemana, $faker);
            
            $notaVenta = \App\Models\NotaVenta::create([
                'monto' => 0,
                'fecha' => $fecha,
                'cliente_id' => $faker->randomElement($clientes),
                'usuario_id' => $faker->randomElement($usuarios),
                'tipo_pago_id' => $this->seleccionarTipoPago($faker, $tiposPago),
            ]);

            $total = 0;
            $productosUsados = [];
            $productosSeleccionados = $productos->random($numProductos);

            foreach ($productosSeleccionados as $producto) {
                if (in_array($producto->id, $productosUsados)) {
                    continue;
                }
                
                $productosUsados[] = $producto->id;
                
                // Cantidad realista según tipo de producto
                $cantidad = $this->determinarCantidadRealista($producto, $faker);
                
                // Precio realista según categoría del producto
                $precioBase = $this->determinarPrecioRealista($producto, $faker);
                
                // Aplicar variación estacional
                $precio = $this->aplicarVariacionEstacional($precioBase, $fecha, $faker);
                
                $importe = $precio * $cantidad;
                $total += $importe;

                \App\Models\DetalleVenta::create([
                    'nota_venta_id' => $notaVenta->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $cantidad,
                    'precio_venta' => $precio,
                    'importe' => $importe,
                ]);
            }

            $notaVenta->update(['monto' => $total]);
        }
    }
    
    /**
     * Genera una fecha más realista con patrones estacionales
     */
    private function generarFechaRealista($faker, $fechaInicio, $fechaFin)
    {
        $fecha = $faker->dateTimeBetween($fechaInicio, $fechaFin);
        $carbonFecha = Carbon::instance($fecha);
        
        // Reducir probabilidad de ventas en domingos
        if ($carbonFecha->isSunday() && $faker->boolean(30)) {
            $carbonFecha->addDay();
        }
        
        // Aumentar probabilidad de ventas en viernes y sábados
        if (($carbonFecha->isFriday() || $carbonFecha->isSaturday()) && $faker->boolean(20)) {
            // Mantener la fecha
        }
        
        return $carbonFecha;
    }
    
    /**
     * Determina número de productos según día de la semana
     */
    private function determinarNumeroProductos($diaSemana, $faker)
    {
        // Lunes a viernes: más productos por venta
        if ($diaSemana >= 1 && $diaSemana <= 5) {
            return $faker->numberBetween(1, 6);
        }
        // Sábados: ventas medianas
        elseif ($diaSemana == 6) {
            return $faker->numberBetween(1, 4);
        }
        // Domingos: menos productos
        else {
            return $faker->numberBetween(1, 3);
        }
    }
    
    /**
     * Selecciona tipo de pago con distribución realista
     */
    private function seleccionarTipoPago($faker, $tiposPago)
    {
        // 60% efectivo, 40% otros métodos
        if ($faker->boolean(60)) {
            return $tiposPago[0]; // Asumir que el primer tipo es efectivo
        }
        return $faker->randomElement($tiposPago);
    }
    
    /**
     * Determina cantidad realista según tipo de producto
     */
    private function determinarCantidadRealista($producto, $faker)
    {
        // Obtener categoría del producto para determinar cantidad típica
        $categoria = $producto->categoria;
        
        if ($categoria) {
            $nombreCategoria = strtolower($categoria->nombre ?? '');
            
            // Medicamentos: cantidades pequeñas
            if (str_contains($nombreCategoria, 'medicamento') || 
                str_contains($nombreCategoria, 'medicina') ||
                str_contains($nombreCategoria, 'antibiotico')) {
                return $faker->numberBetween(1, 3);
            }
            // Alimentos: cantidades medianas
            elseif (str_contains($nombreCategoria, 'alimento') || 
                    str_contains($nombreCategoria, 'comida')) {
                return $faker->numberBetween(1, 8);
            }
            // Accesorios/juguetes: cantidades variables
            elseif (str_contains($nombreCategoria, 'accesorio') || 
                    str_contains($nombreCategoria, 'juguete')) {
                return $faker->numberBetween(1, 5);
            }
            // Higiene/cuidado: cantidades medianas
            elseif (str_contains($nombreCategoria, 'higiene') || 
                    str_contains($nombreCategoria, 'cuidado') ||
                    str_contains($nombreCategoria, 'shampoo')) {
                return $faker->numberBetween(1, 4);
            }
        }
        
        // Por defecto
        return $faker->numberBetween(1, 5);
    }
    
    /**
     * Determina precio realista según categoría del producto
     */
    private function determinarPrecioRealista($producto, $faker)
    {
        $categoria = $producto->categoria;
        
        if ($categoria) {
            $nombreCategoria = strtolower($categoria->nombre ?? '');
            
            // Medicamentos: precios altos
            if (str_contains($nombreCategoria, 'medicamento') || 
                str_contains($nombreCategoria, 'medicina') ||
                str_contains($nombreCategoria, 'antibiotico')) {
                return $faker->randomFloat(2, 25, 150);
            }
            // Alimentos: precios medios
            elseif (str_contains($nombreCategoria, 'alimento') || 
                    str_contains($nombreCategoria, 'comida')) {
                return $faker->randomFloat(2, 15, 80);
            }
            // Accesorios: precios variables
            elseif (str_contains($nombreCategoria, 'accesorio') || 
                    str_contains($nombreCategoria, 'juguete')) {
                return $faker->randomFloat(2, 8, 60);
            }
            // Higiene: precios medios
            elseif (str_contains($nombreCategoria, 'higiene') || 
                    str_contains($nombreCategoria, 'cuidado') ||
                    str_contains($nombreCategoria, 'shampoo')) {
                return $faker->randomFloat(2, 12, 45);
            }
            // Servicios veterinarios: precios altos
            elseif (str_contains($nombreCategoria, 'servicio') || 
                    str_contains($nombreCategoria, 'consulta') ||
                    str_contains($nombreCategoria, 'cirugia')) {
                return $faker->randomFloat(2, 50, 300);
            }
        }
        
        // Precio por defecto
        return $faker->randomFloat(2, 10, 100);
    }
    
    /**
     * Aplica variación estacional a los precios
     */
    private function aplicarVariacionEstacional($precioBase, $fecha, $faker)
    {
        $mes = $fecha->month;
        $variacion = 1.0;
        
        // Temporada alta (Diciembre-Enero): precios ligeramente más altos
        if ($mes == 12 || $mes == 1) {
            $variacion = $faker->randomFloat(3, 1.05, 1.15);
        }
        // Temporada media (Junio-Agosto): precios normales con pequeña variación
        elseif ($mes >= 6 && $mes <= 8) {
            $variacion = $faker->randomFloat(3, 1.02, 1.08);
        }
        // Temporada baja (Marzo-Mayo, Septiembre-Noviembre): pequeños descuentos
        else {
            $variacion = $faker->randomFloat(3, 0.95, 1.05);
        }
        
        return round($precioBase * $variacion, 2);
    }
}