<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Delegation extends Model
{
    use HasFactory;

    protected $table = 'delegations';

    protected $fillable = [
        'id_region',
        'delegacion',
        'nivel_delegaciona',
        'sede_delegaciona',
    ];

    // Definir la relación uno a muchos inversa
    public function users()
    {
        return $this->hasMany(User::class, 'id_delegacion');
    }    


    public function region(){
        return $this->belongsTo(Region::class, 'id_region');
    }    
}