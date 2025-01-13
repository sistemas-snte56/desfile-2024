<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Teacher;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PdfController extends Controller
{
   public function generadorPDF(Teacher $maestro, $codigo_id)
   {
        // Obtener el maestro correspondiente al código_id

        try {
            $maestro = Teacher::where('codigo_id',$codigo_id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            abort(404);
        }

        # Construir el enlace con el código_id para el QR
        $enlace = route('usuario.teacher.constancia', ['codigo_id' => $codigo_id]);
        $maestro->codigo_qr = $enlace;
        
        $maestro->update();

        $pdf = PDF::loadView('usuario.pdf.index', compact('maestro'))
            ->setPaper('letter','portrait')
            ->setOption(['dpi' => 200, 'defaultFont' => 'Helvetica'])
            ->setWarnings(false)
            ->save('constancia.pdf');
        return $pdf->stream();    
   }
}
