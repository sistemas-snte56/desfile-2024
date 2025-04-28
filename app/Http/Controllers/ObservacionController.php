<?php

namespace App\Http\Controllers;

use App\Models\Observacion;
use Illuminate\Http\Request;

class ObservacionController extends Controller
{
    public function store(Request $request)
    {
        // Validamos los datos recibidos
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'mensaje' => 'required|string'
        ]);

        // Creamos la observación
        Observacion::create([
            'user_id' => $request->user_id, // Usuario que está siendo cotejado
            'cotejador_id' => auth()->id(), // El cotejador logueado
            'mensaje' => $request->mensaje
        ]);

        return back()->with('success', 'Observación guardada correctamente.');
    }

    // Método para que el admin marque la observación como atendida
    public function atender(Observacion $observacion)
    {
        // Verificamos si el admin está atendiendo la observación
        $observacion->update(['atendida' => true]);

        // Marcamos el `status_lista` del usuario como verdadero
        $observacion->user->update(['status_lista' => true]);

        return back()->with('success', 'Observación atendida y usuario habilitado en lista.');
    }
}
