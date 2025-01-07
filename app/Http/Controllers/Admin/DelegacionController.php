<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin\Region;
use Illuminate\Http\Request;
use App\Models\Admin\Delegation;
use App\Http\Controllers\Controller;

class DelegacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $delegaciones = Delegation::orderBy('delegacion','asc')->get();
        return view('admin.delegations.index', compact('delegaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regiones = Region::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->region . ' - ' . $item->sede];
        })->toArray();

        return view('admin.delegations.create', compact('regiones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'select_region' => ['required'],
            'delegacion' => ['required', 'unique:delegations,delegacion'],
            'nivel' => ['required'],
            'sede' => ['required'],
        ]);

        // Guardar el nuevo registro
        Delegation::create([
            'id_region' => $request->input('select_region'),
            'delegacion' => mb_strtoupper($request->input('delegacion'),'UTF-8'),
            'nivel_delegaciona' => mb_strtoupper($request->input('nivel'),'UTF-8'),
            'sede_delegaciona' => mb_strtoupper($request->input('sede'),'UTF-8'),
        ]);        

        return redirect()->route('delegacion.index')->with('success_delegacion','Registro guardado');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $delegacion = Delegation::find($id);

        $regiones = Region::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->region . ' - ' . $item->sede];
        })->toArray();



        return view('admin.delegations.edit', compact('regiones','delegacion'));    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'select_region' => ['required'],
            'delegacion' => ['required', 'unique:delegations,delegacion,'.$id],
            'nivel' => ['required'],
            'sede' => ['required'],
        ]);

        // Buscar el registro a actualizar
        $delegacion = Delegation::findOrFail($id);  // Buscar el registro por su ID

        // Guardar el nuevo registro
        $delegacion->update([
            'id_region' => $request->input('select_region'),
            'delegacion' => mb_strtoupper($request->input('delegacion'),'UTF-8'),
            'nivel_delegaciona' => mb_strtoupper($request->input('nivel'),'UTF-8'),
            'sede_delegaciona' => mb_strtoupper($request->input('sede'),'UTF-8'),
        ]);        

        return redirect()->route('delegacion.index')->with('update_delegacion','Registro actualizado');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delegation::destroy($id);


        // Primero, eliminar los registros en 'maestros' relacionados con 'users'
        $users = User::where('id_delegacion', $id)->get();

        //return $users;
        
        foreach ($users as $user) {
            // Eliminar los registros en 'maestros' que están relacionados con este 'user'
            // $user->maestros()->delete();  // Esto eliminará los registros en 'maestros'
            $user->delete();  // Luego elimina el 'user'
        }

        // Luego, eliminar la 'delegation'
        $delegation = Delegation::findOrFail($id);
        $delegation->delete();





        return redirect()->route('delegacion.index')->with('destroy_delegacion','Delegación eliminada');
    }
}
