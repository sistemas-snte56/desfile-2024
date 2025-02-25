<?php

namespace App\Livewire;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class GenerarPdf extends Component
{
    #[Reactive]
    public $codigo_id;

    public function generarPdf()
    {
        return redirect()->route('teacher.constancia',['codigo_id' => $this->codigo_id]);
    }

    public function render()
    {
        return view('livewire.generar-pdf');
    }
}
