<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Almacen;


class AlmacenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Almacen::create([
            'nombre' => 'Almacén Central',
            'ubicacion' => 'Avenida Principal #123',
            'capacidad' => 1000,
        ]);

        Almacen::create([
            'nombre' => 'Almacén Norte',
            'ubicacion' => 'Calle Secundaria #45',
            'capacidad' => 500,
        ]);

        Almacen::create([
            'nombre' => 'Almacén Sur',
            'ubicacion' => 'Zona Industrial S/N',
            'capacidad' => 750,
        ]);
    }
}
