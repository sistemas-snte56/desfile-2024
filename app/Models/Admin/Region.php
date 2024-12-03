<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = 'regions';

    protected $fillable = [
        'region',
        'sede',
    ];

    public function delegations()
    {
        return $this->hasMany(Delegation::class, 'id_region');
    }      
}