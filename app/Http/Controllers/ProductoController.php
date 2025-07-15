<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Almacen;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::with(['categoria', 'almacen']);
        
        // Aplicar búsqueda si existe
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('codigo', 'LIKE', "%{$search}%")
                  ->orWhere('descripcion', 'LIKE', "%{$search}%")
                  ->orWhereHas('categoria', function($catQuery) use ($search) {
                      $catQuery->where('nombre', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('almacen', function($almQuery) use ($search) {
                      $almQuery->where('nombre', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        // Ordenar por ID descendente (más recientes primero)
        $productos = $query->orderBy('id', 'asc')->paginate(10);

        // Mantener los parámetros de búsqueda en la paginación
        $productos->appends($request->query());
        
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $almacenes = Almacen::all();
        return view('productos.form', compact('categorias', 'almacenes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'codigo' => 'required|string|max:50|unique:productos,codigo',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'almacen_id' => 'required|exists:almacens,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('productos', 'public');
        }

        Producto::create($data);

        return redirect()->route('productos.index')->with('success', 'Producto creado con éxito.');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $almacenes = Almacen::all();
        return view('productos.form', compact('producto', 'categorias', 'almacenes'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'codigo' => 'required|string|max:50|unique:productos,codigo,' . $producto->id,
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'almacen_id' => 'required|exists:almacens,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('productos', 'public');
        }

        $producto->update($data);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado con éxito.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado con éxito.');
    }
}
