<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string'],
        ]);
        
        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name' => 'web',  // Especificamos el guard_name manualmente
        ]);
        return redirect()->route('role.index')->with('success_role','Registro Guardado');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('admin.role-permission.index',compact('role','permissions','rolePermissions'));
    }

    public function updateRolePermission(Request $request, string $id)
    {
        // 'aqui se actualiza los permissos asignados a roles';

        $request->validate([
            'selectPermissions' => ['required'],
        ]);

        $role = Role::find($id);
        $permissionsIds = $request->input('selectPermissions');

        $permissions = Permission::whereIn('id',$permissionsIds)->pluck('name')->toArray();

        $role->syncPermissions($permissions);
        return redirect()->route('role.index')->with('success_permissions','Se asignaron permisos.');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        return view('admin.roles.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // Buscar el permiso por su ID
        $role = Role::find($id);

        $request->validate([
            'name' => ['required','string'],
        ]);

        $role->update([
            'name' => $request->input('name'),
            'guard_name' => 'web',  // Especificamos el guard_name manualmente
        ]);

        return redirect()->route('role.index')->with('update_role','Role Actualizado');
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('role.index')->with('destroy_role','Role Borrado');
    }
}
