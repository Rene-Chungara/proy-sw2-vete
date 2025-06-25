<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoPago;


class TipoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoPago::create([
            'nombre' => 'Efectivo',
        ]);

        TipoPago::create([
            'nombre' => 'Tarjeta',
        ]);

        TipoPago::create([
            'nombre' => 'QR',
        ]);
    }
}
