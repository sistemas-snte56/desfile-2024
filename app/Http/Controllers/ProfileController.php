<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin\Region;
use Illuminate\Http\Request;
use App\Models\Admin\Delegation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $regiones = Region::all();
        $delegaciones = Delegation::all();

        // return $user;
        return view('user.index', compact('user','regiones','delegaciones'));
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
        return redirect()->route('usuario.profile.index')->with('success', 'Información actualizada.');
    }
}
