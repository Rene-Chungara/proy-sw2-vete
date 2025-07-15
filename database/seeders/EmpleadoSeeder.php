<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empleados = [
            [
                'ci' => '12345678',
                'nombre' => 'Dr. Carlos Mendoza Vargas',
                'sexo' => 'M',
                'cargo' => 'Veterinario Principal',
                'direccion' => 'Av. Cristóbal de Mendoza #456, Santa Cruz',
                'telefono' => '78912345',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ci' => '87654321',
                'nombre' => 'Dra. María Elena Rojas',
                'sexo' => 'F',
                'cargo' => 'Veterinaria Especialista',
                'direccion' => 'Barrio Las Palmas, Calle 2 #123',
                'telefono' => '76543210',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ci' => '11223344',
                'nombre' => 'Ana Patricia Sánchez',
                'sexo' => 'F',
                'cargo' => 'Recepcionista',
                'direccion' => 'Villa 1ro de Mayo, Calle Los Pinos #789',
                'telefono' => '79856234',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ci' => '44332211',
                'nombre' => 'Luis Alberto Fernández',
                'sexo' => 'M',
                'cargo' => 'Asistente Veterinario',
                'direccion' => 'Barrio San Antonio, Av. Santos Dumont #234',
                'telefono' => '77412365',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ci' => '55667788',
                'nombre' => 'Carmen Rosa Gutiérrez',
                'sexo' => 'F',
                'cargo' => 'Enfermera Veterinaria',
                'direccion' => 'Plan 3000, UV 45 Mz 12 #567',
                'telefono' => '78523697',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ci' => '99887766',
                'nombre' => 'Jorge Miguel Torres',
                'sexo' => 'M',
                'cargo' => 'Auxiliar de Limpieza',
                'direccion' => 'Barrio Urbari, Calle Final #890',
                'telefono' => '76985412',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ci' => '13579246',
                'nombre' => 'Dra. Patricia Morales Vaca',
                'sexo' => 'F',
                'cargo' => 'Veterinaria Cirujana',
                'direccion' => 'Equipetrol, Calle Las Barreras #345',
                'telefono' => '79753486',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ci' => '86420975',
                'nombre' => 'Roberto Carlos Chávez',
                'sexo' => 'M',
                'cargo' => 'Administrador',
                'direccion' => 'Centro, Calle Junín #456',
                'telefono' => '77896325',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ci' => '24681357',
                'nombre' => 'Silvia Marcela Peña',
                'sexo' => 'F',
                'cargo' => 'Cajera',
                'direccion' => 'Barrio Hamacas, Calle Los Cedros #123',
                'telefono' => '78659741',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ci' => '97531864',
                'nombre' => 'Dr. Fernando Justiniano',
                'sexo' => 'M',
                'cargo' => 'Veterinario de Emergencias',
                'direccion' => 'Av. Alemana #789, 4to Anillo',
                'telefono' => '76321987',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('empleados')->insert($empleados);
    }
}
