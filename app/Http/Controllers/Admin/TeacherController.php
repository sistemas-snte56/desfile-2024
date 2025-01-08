<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Teacher;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtén el usuario autenticado
        $user = Auth::user();

        // Obtén todos los maestros que pertenecen a este usuario
        $teachers = Teacher::where('id_user', $user->id)->get();

        // Puedes pasar los maestros a la vista o utilizarlos en la lógica de tu aplicación
        return view('usuario.index', compact('teachers', 'user'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuario.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required'],
            'apellido_paterno' => ['required'],

            // Validación del número de personal: único por usuario
            'npersonal' => [
                'required',
                'numeric',
                // Validar que el número de personal es único para el usuario autenticado
                Rule::unique('teacher')->where(function ($query) {
                    return $query->where('id_user', Auth::id());
                }),
            ],
            'rfc' => ['required','regex:/^[a-zA-Z]{4}[0-9]{6}[a-zA-Z0-9]{3}$/'],
            'select_genero' => ['required'],
            'telefono' => ['required','numeric','digits:10'],
            // 'email' => ['required','email','unique:teacher,email'],

            
            'email' => [
                'required',
                'email',
                Rule::unique('teacher')->where(function ($query) {
                    return $query->where('id_user', Auth::id());
                }),
            ],

        ]);


        $user = Auth::user();

        // return $user->id;



        // Generar un slug basado en el nombre completo
        $slug = Str::slug($request->input('nombre').'-'.$request->input('apellido_paterno').'-'.$request->input('apellido_materno'));



        // Verificar si el slug ya existe y si es necesario agregar un sufijo único
        $originalSlug = $slug;
        $counter = 1;
        while (Teacher::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;  // Agregar un sufijo si ya existe
            $counter++;
        }




        // Intentar guardar el Teacher con el slug único
        try {

            $maestro = new Teacher();
            $maestro->id_user = $user->id;
            $maestro->id_delegacion = $user->id_delegacion;
            $maestro->nombre = mb_strtoupper($request->input('nombre'),'UTF-8');
            $maestro->apaterno = mb_strtoupper($request->input('apellido_paterno'),'UTF-8');
            $maestro->amaterno = mb_strtoupper($request->input('apellido_materno'),'UTF-8');
            $maestro->npersonal = $request->input('npersonal');
            $maestro->rfc = mb_strtoupper($request->input('rfc'),'UTF-8');
            $maestro->genero = mb_strtoupper($request->input('select_genero'),'UTF-8');
            $maestro->telefono = $request->input('telefono');
            $maestro->email = $request->input('email');

            $maestro->folio = 'SNT56-CPM25-' . mb_strtoupper(substr(uniqid(), -5));

            $maestro->codigo_id = sprintf(
                "%04s-%04s-%04s-%04s",
                substr(uniqid(), 0, 4),
                substr(uniqid(), 4, 4),
                substr(uniqid(), 8, 4),
                substr(uniqid(), 12, 4)
            );
            $maestro->slug = $slug;
            $maestro->save();

            // Redirigir o responder con éxito
            return redirect()->route('usuario.index')->with('success_maestro','Registro guardado');
        } catch (QueryException $e) {
            // Si hay un error específico de SQL (por ejemplo, violación de restricción)
            if ($e->getCode() === '23000') {  // Error de integridad (duplicado)
                return back()->withErrors(['slug' => 'El slug ya existe. Por favor, elija otro.']);
            }

            // Manejar otros tipos de errores
            return back()->withErrors(['error' => 'Ha ocurrido un error inesperado.']);
        }


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
    public function edit($slug)
    {
        // return "Hola";
        // Buscar el post usando el slug
        $teacher = Teacher::where('slug', $slug)->firstOrFail();

        return view('usuario.teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $teacher = Teacher::where('slug', $slug)->firstOrFail();

        $request->validate([
            'nombre' => ['required'],
            'apellido_paterno' => ['required'],
            'npersonal' => ['required','numeric'],
            'rfc' => ['required','regex:/^[a-zA-Z]{4}[0-9]{6}[a-zA-Z0-9]{3}$/'],
            'select_genero' => ['required'],
            'telefono' => ['required','numeric','digits:10'],
            'email' => ['required','email']
        ]);


        try {
            $teacher->update([
                'nombre' => mb_strtoupper($request->nombre,'UTF-8'),
                'apaterno' => mb_strtoupper($request->apellido_paterno,'UTF-8'),
                'amaterno' => mb_strtoupper($request->apellido_materno,'UTF-8'),
                'npersonal' => $request->npersonal,
                'rfc' => mb_strtoupper($request->rfc,'UTF-8'),
                'genero' => mb_strtoupper($request->select_genero,'UTF-8'),
                'telefono' => $request->telefono,
                'email' => $request->email,
            ]);
    
            return redirect()->route('usuario.index')->with('update_maestro','Registro actualizado');

        } catch (QueryException $e) {
            // Si hay un error específico de SQL (por ejemplo, violación de restricción)
            if ($e->getCode() === '23000') {  // Error de integridad (duplicado)
                return back()->withErrors(['slug' => 'El slug ya existe. Por favor, elija otro.']);
            }

            // Manejar otros tipos de errores
            return back()->withErrors(['error' => 'Ha ocurrido un error inesperado.']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        try {
            // Find the teacher by slug (assuming 'slug' is the column name)
            $teacher = Teacher::where('slug', $slug)->firstOrFail();
    
            // Optionally, delete the teacher record
            $teacher->delete();
    
            // return response()->json(['destroy_teacher' => 'Teacher deleted successfully.'], 200);
            return redirect()->route('usuario.index')->with('destroy_teacher','Usuario eliminado.');
        } catch (ModelNotFoundException $e) {
            // return response()->json(['error' => 'Teacher not found.'], 404);
            return redirect()->route('usuario.index')->with('error_404','Usuario no encontrado.');
        } catch (Exception $e) {
            return redirect()->route('usuario.index')->with('error_500','Error encontrado.');
            // return response()->json(['error' => 'An error occurred while trying to delete the teacher.'], 500);
        }        

    }
}
