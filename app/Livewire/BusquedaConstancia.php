<?php

namespace App\Livewire;

use App\Models\Admin\Teacher;
use Livewire\Component;

class BusquedaConstancia extends Component
{

    public $id_user;
    public $userFound = false;
    public $status = 0;

    public $numero_de_personal = '';
    public $teachers;
    public $codigo_id;

    public function buscarConstancia()
    {
        $this->validate([
            'numero_de_personal' => 'required|numeric|exists:teacher,npersonal',
        ],[
            'numero_de_personal.exists' => 'El número de personal no existe',
        ]);

        // Buscamos todos los maestros que tengan el número de personal que se ingresó
        $this->teachers = Teacher::where('npersonal', $this->numero_de_personal)->get();

        // Ahora extraes el código ID y lo almacenas en la variable $codigo_id
        $this->codigo_id = $this->teachers->pluck('codigo_id')->first();
        //dd($this->codigo_id);

        // Si no se encontró ningún maestro con el número de personal ingresado
        if ($this->teachers->isEmpty()) {
            session()->flash('error', 'No se encontró ningún maestro con el número de personal ingresado');
        }

        $this->reset('numero_de_personal');


    }

    public function render()
    {
        return view('livewire.busqueda-constancia');
    }
}
