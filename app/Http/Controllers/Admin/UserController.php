<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin\Region;
use Illuminate\Http\Request;
use App\Models\Admin\Delegation;
use Spatie\Permission\Models\Role;
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

        $users = User::all();

        $regiones = Region::all();
        $delegaciones = Delegation::all();

        // return $user;
        return view('admin.users.index', compact('users','regiones','delegaciones'));
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
        $user = User::find($id);
        $allRoles = Role::all();
        
        $userRoles = $user->roles->pluck('id')->toArray();

        $userRolesName = $user->roles->pluck('name')->toArray();

        

        $regiones = Region::all();
        $delegaciones = Delegation::all();

        // return $user;
        return view('admin.users.show', compact('user','regiones','delegaciones','allRoles','userRoles','userRolesName'));

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
            'selectRoles' => ['required'],
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

        $rolesIds = $request->input('selectRoles', []);
        $roles = Role::whereIn('id',$rolesIds)->pluck('name');
        $user->syncRoles($roles);


        // Redireccionar con mensaje de éxito
        return redirect()->route('user.index')->with('success', 'Información actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
