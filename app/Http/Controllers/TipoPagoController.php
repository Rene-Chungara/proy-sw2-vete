<?php

namespace App\Http\Controllers;

use App\Models\TipoPago;
use Illuminate\Http\Request;

class TipoPagoController extends Controller
{
    public function index()
    {
        $tipo_pagos = TipoPago::paginate(10);
        return view('tipo_pagos.index', compact('tipo_pagos'));
    }

    public function create()
    {
        return view('tipo_pagos.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50|unique:tipo_pagos,nombre',
        ]);

        TipoPago::create($request->all());

        return redirect()->route('tipo_pagos.index')->with('success', 'Tipo de pago creado con éxito.');
    }

    public function edit(TipoPago $tipo_pago)
    {
        return view('tipo_pagos.form', compact('tipo_pago'));
    }

    public function update(Request $request, TipoPago $tipo_pago)
    {
        $request->validate([
            'nombre' => 'required|string|max:50|unique:tipo_pagos,nombre,' . $tipo_pago->id,
        ]);

        $tipo_pago->update($request->all());

        return redirect()->route('tipo_pagos.index')->with('success', 'Tipo de pago actualizado con éxito.');
    }

    public function destroy(TipoPago $tipo_pago)
    {
        $tipo_pago->delete();
        return redirect()->route('tipo_pagos.index')->with('success', 'Tipo de pago eliminado con éxito.');
    }
}
