<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    use HasFactory;

    // Campos que se pueden llenar de forma masiva
    protected $table = 'observaciones';
    protected $fillable = ['user_id', 'cotejador_id', 'mensaje', 'atendida'];

    // Relación con el usuario observado
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con el cotejador (quien hizo la observación)
    public function cotejador()
    {
        return $this->belongsTo(User::class, 'cotejador_id');
    }    
}
