<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function __construct()
    {
        // Verificar si el usuario tiene permiso para ver todos los recursos (index)
        $this->middleware('permission:permission.index')->only('index');

        // Verificar si el usuario tiene permiso para ver un recurso específico (show)
        $this->middleware('permission:permission.show')->only('show');

        // Verificar si el usuario tiene permiso para editar un recurso (edit, update)
        $this->middleware('permission:permission.edit')->only('edit', 'update');

        // Verificar si el usuario tiene permiso para eliminar un recurso (destroy)
        $this->middleware('permission:permission.destroy')->only('destroy');

        // Verificar si el usuario tiene permiso para crear un recurso (create, store)
        $this->middleware('permission:permission.create')->only('create', 'store');
    }




    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string'],
        ]);

        $permission = Permission::create([
            'name' => $request->input('name'),
            'guard_name' => 'web',  // Especificamos el guard_name manualmente
        ]);
        return redirect()->route('permission.index')->with('success_permission','Permisso Guardado');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::find($id);
        return view('admin.permissions.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Buscar el permiso por su ID
        $permission = Permission::find($id);

        $request->validate([
            'name' => ['required','string'],
        ]);

        $permission->update([
            'name' => $request->input('name'),
            'guard_name' => 'web',  // Especificamos el guard_name manualmente
        ]);
        return redirect()->route('permission.index')->with('update_permission','Permisso Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->route('permission.index')->with('destroy_permission','Permisso Borrado');
    }
}
