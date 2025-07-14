<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            // Medicamentos
            'Antibióticos',
            'Antiinflamatorios',
            'Analgésicos',
            'Antiparasitarios',
            'Vitaminas y Suplementos',
            'Vacunas',
            'Desparasitantes',
            'Tratamientos Dérmicos',
            'Medicamentos Cardíacos',
            'Medicamentos Respiratorios',
            'Medicamentos Digestivos',
            'Sedantes y Tranquilizantes',
            'Antisépticos y Desinfectantes',
            
            // Alimentos
            'Alimento para Perros',
            'Alimento para Gatos',
            'Alimento para Aves',
            'Alimento para Peces',
            'Alimento para Roedores',
            'Alimento para Reptiles',
            'Snacks y Premios',
            'Leche Maternizada',
            'Alimento Medicado',
            'Suplementos Nutricionales',
            
            // Accesorios y Cuidado
            'Collares y Correas',
            'Juguetes',
            'Camas y Casas',
            'Transportadoras',
            'Bebederos y Comederos',
            'Arena para Gatos',
            'Productos de Higiene',
            'Champú y Acondicionadores',
            'Cepillos y Peines',
            'Cortaúñas',
            'Productos Dentales',
            
            // Material Veterinario
            'Instrumental Quirúrgico',
            'Material de Curación',
            'Jeringas y Agujas',
            'Guantes Desechables',
            'Vendas y Gasas',
            'Sueros y Soluciones',
            'Termómetros',
            'Fonendoscopios',
            'Básculas',
            
            // Productos Especializados
            'Productos para Equinos',
            'Productos para Bovinos',
            'Productos para Porcinos',
            'Productos para Ovinos',
            'Productos Avícolas',
            'Productos para Fauna Silvestre',
            'Productos de Reproducción',
            'Insecticidas y Repelentes',
            'Productos de Laboratorio',
            'Equipos de Diagnóstico',
            
            // Cuidado Especializado
            'Productos Geriátricos',
            'Productos para Cachorros',
            'Productos Dietéticos',
            'Productos Oncológicos',
            'Productos Dermatológicos',
            'Productos Oftálmicos',
            'Productos Otológicos',
            'Productos Neurológicos',
            'Productos Endocrinos',
            'Productos de Rehabilitación'
        ];

        foreach ($categorias as $categoria) {
            Categoria::create([
                'nombre' => $categoria,
            ]);
        }
    }
}
