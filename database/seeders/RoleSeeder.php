<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'empleado']);
        $role2 = Role::create(['name' => 'admin']);

        //-----------------Mostrar Roles
        Permission::create(['name' => 'roles.index'])->syncRoles([$role2]);
        Permission::create(['name' => 'roles.create'])->syncRoles([$role2]);
        Permission::create(['name' => 'roles.edit'])->syncRoles([$role2]);
        Permission::create(['name' => 'roles.destroy'])->syncRoles([$role2]);

        //----------------Mostrar Empleados
        Permission::create(['name' => 'Empleado.index'])->syncRoles([$role2]);
        Permission::create(['name' => 'Empleado.create'])->syncRoles([$role2]);
        Permission::create(['name' => 'Empleado.edit'])->syncRoles([$role2]);
        Permission::create(['name' => 'Empleado.destroy'])->syncRoles([$role2]);

        //-----------------Mostrar Categoria
        Permission::create(['name' => 'Categoria.index'])->syncRoles([$role2]);
        Permission::create(['name' => 'Categoria.create'])->syncRoles([$role2]);
        Permission::create(['name' => 'Categoria.edit'])->syncRoles([$role2]);
        Permission::create(['name' => 'Categoria.destroy'])->syncRoles([$role2]);

        //-----------------Mostrar productos
        Permission::create(['name' => 'Producto.index'])->syncRoles([$role2]);
        Permission::create(['name' => 'Producto.catalogo'])->syncRoles([$role1]);
        Permission::create(['name' => 'Producto.create'])->syncRoles([$role2]);
        Permission::create(['name' => 'Producto.edit'])->syncRoles([$role2]);
        Permission::create(['name' => 'Producto.destroy'])->syncRoles([$role2]);

        Permission::create(['name' => 'bitacora.index'])->syncRoles([$role2]);
        Permission::create(['name' => 'reporte'])->syncRoles([$role2]);
        Permission::create(['name' => 'laboratorio'])->syncRoles([$role2]);
        Permission::create(['name' => 'cliente'])->syncRoles([$role2]);
        Permission::create(['name' => 'nota de entrada'])->syncRoles([$role2]);
        Permission::create(['name' => 'nota de salida'])->syncRoles([$role2]);
    }
}
