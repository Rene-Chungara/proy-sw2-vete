<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::paginate(10);
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'required|email|unique:proveedors,correo',
            'ciudad' => 'nullable|string|max:100',
            'pais' => 'nullable|string|max:100',
        ]);

        Proveedor::create($request->all());

        return redirect()->route('proveedores.index')->with('success', 'Proveedor creado con éxito.');
    }

    public function edit(Proveedor $proveedor)
    {
        return view('proveedores.form', compact('proveedor'));
    }

    public function update(Request $request, Proveedor $proveedor)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'required|email|unique:proveedors,correo,' . $proveedor->id,
            'ciudad' => 'nullable|string|max:100',
            'pais' => 'nullable|string|max:100',
        ]);

        $proveedor->update($request->all());

        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado con éxito.');
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado con éxito.');
    }
}
