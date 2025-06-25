<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /* public function __construct()
     {
         $this->middleware('can:roles.index')->only('index');
         $this->middleware('can:roles.create')->only('create', 'store');
         $this->middleware('can:roles.edit')->only('edit', 'update');
         $this->middleware('can:roles.destroy')->only('destroy');
     }*/
    public function index()
    {
        return view('rol.index', ['roles' => Role::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('rol.form', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array'
        ]);
        $role = Role::create(['name' => $validated['name']]);
        $permissions = Permission::whereIn('id', $validated['permissions'] ?? [])
                        ->pluck('name')
                        ->toArray();
        $role->syncPermissions($permissions);
        activity()
            ->causedBy(auth()->user())
            ->log('Se creó un nuevo rol: ' . $role->name . ' desde IP ' . request()->ip());
        return redirect()->route('roles.index')->with('success', 'Rol creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('rol.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('rol.form', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role){
        $validated = $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array'
        ]);
        $role->update(['name' => $validated['name']]);
        $permissions = Permission::whereIn('id', $validated['permissions'] ?? [])
                        ->pluck('name')
                        ->toArray();
        $role->syncPermissions($permissions);
        activity()
            ->causedBy(auth()->user())
            ->log('Se actualizó el rol: ' . $role->name . ' desde IP ' . request()->ip());
        return redirect()->route('roles.index')->with('success', 'Rol actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = role::find($id);
        $role->delete();
        $ip = request()->ip();
        activity()
            ->causedBy(auth()->user()) // El usuario responsable de la actividad
            ->log('Se elimino el rol: ' . $role->name . $ip);
        // activity()->useLog('Rol')->log('eliminado')->subject($role);
        return redirect()->route('roles.index')->with('info', 'El rol se eliminó con exito');
    }
}

