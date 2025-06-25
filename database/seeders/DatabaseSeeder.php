<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CategoriaSeeder::class,
            AlmacenSeeder::class,
            ProveedorSeeder::class,
            ClienteSeeder::class,
            TipoPagoSeeder::class,
            EmpleadoSeeder::class,
            UserSeeder::class,
            ProductoSeeder::class,
            NotaVentaSeeder::class,
            NotaEntradaSeeder::class,
        ]);
    }
}
