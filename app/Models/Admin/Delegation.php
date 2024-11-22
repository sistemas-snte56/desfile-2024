<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

