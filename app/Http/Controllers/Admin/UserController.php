<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin\Region;
use Illuminate\Http\Request;
use App\Models\Admin\Delegation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Filtrar delegaciones que están asociadas al usuario autenticado
        // (Asumiendo que tienes una relación con 'user_id' en la tabla 'delegacions')
        $delegaciones = Delegation::where('user_id', $user->id)
                                ->orderBy('nombre', 'asc')
                                ->get();

        // Pasar las delegaciones a la vista        
        $delegaciones = Delegation::orderBy('delegacion','asc')->get();
        */

        $user = Auth::user();

        $regiones = Region::all();
        $delegaciones = Delegation::all();

        // return $user;
        return view('admin.users.index', compact('user','regiones','delegaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'select_delegacion' => ['required','numeric'],
            'select_cargo' => ['required','string'],
            'nombre' => ['required','string'],
            'apaterno' => ['required','string'],
            'amaterno' => ['required','string'],
            'email' => ['required','email'],
        ]);


        if (!empty($request->input('current_password'))) {

            // Validación de contraseñas
            $request->validate([
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:8|confirmed',
            ]);            

            // Verificar si la contraseña actual es correcta
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
            }     
                    
            // Actualizar la contraseña
            $user->password = Hash::make($request->new_password);
            $user->save();            
            
        } 

        $user->id_delegacion = $request->input('select_delegacion');
        $user->cargo = $request->input('select_cargo');
        $user->nombre = $request->input('nombre');
        $user->apaterno = $request->input('apaterno');
        $user->amaterno = $request->input('amaterno');
        $user->email = $request->input('email');
        $user->save(); 
        
        // Redireccionar con mensaje de éxito
        return redirect()->route('admin.user.index')->with('success', 'Información actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
