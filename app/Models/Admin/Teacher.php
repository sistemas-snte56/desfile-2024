<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teacher';

    protected $fillable = 
    [
       'id_user',
       'id_delegacion',
       'nombre',
       'apaterno',
       'amaterno',
       'npersonal',
       'rfc',
       'genero',
       'telefono',
       'email',
       'folio',
       'codigo_id',
       'codigo_qr',
       'slug',        
    ];

    // Un Teacher pertenece a un User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }    
}
