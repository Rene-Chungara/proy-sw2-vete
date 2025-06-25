<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    public function index()
    {
        $almacenes = Almacen::paginate(10);
        return view('almacenes.index', compact('almacenes'));
    }

    public function create()
    {
        return view('almacenes.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'ubicacion' => 'required|string|max:255',
            'capacidad' => 'required|integer|min:0',
        ]);

        Almacen::create($request->all());

        return redirect()->route('almacenes.index')->with('success', 'Almacén creado con éxito.');
    }

    public function edit(Almacen $almacen)
    {
        return view('almacenes.form', compact('almacen'));
    }

    public function update(Request $request, Almacen $almacen)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'ubicacion' => 'required|string|max:255',
            'capacidad' => 'required|integer|min:0',
        ]);

        $almacen->update($request->all());

        return redirect()->route('almacenes.index')->with('success', 'Almacén actualizado con éxito.');
    }

    public function destroy(Almacen $almacen)
    {
        $almacen->delete();
        return redirect()->route('almacenes.index')->with('success', 'Almacén eliminado con éxito.');
    }
}
