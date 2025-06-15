<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::paginate(10);
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        return view('empleados.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ci' => 'required|unique:empleados,ci|max:20',
            'nombre' => 'required|string|max:100',
            'sexo' => 'nullable|in:M,F',
            'cargo' => 'nullable|string|max:100',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        Empleado::create($request->all());

        return redirect()->route('empleados.index')->with('success', 'Empleado creado exitosamente.');
    }

    public function edit(Empleado $empleado)
    {
        return view('empleados.form', compact('empleado'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
            'ci' => 'required|max:20|unique:empleados,ci,' . $empleado->id,
            'nombre' => 'required|string|max:100',
            'sexo' => 'nullable|in:M,F',
            'cargo' => 'nullable|string|max:100',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        $empleado->update($request->all());

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado exitosamente.');
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado exitosamente.');
    }
}
