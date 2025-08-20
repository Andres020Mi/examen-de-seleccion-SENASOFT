<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proyecto extends Model
{
     use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'fase',
        'user_id',
        'semillero_id',
    ];

    // Relación: un proyecto tiene un líder (usuario)
    public function lider()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación: un proyecto pertenece a un semillero
    public function semillero()
    {
        return $this->belongsTo(Semillero::class);
    }


   // 🔹 Relación: un proyecto tiene muchos trabajos
    public function trabajos()
    {
        return $this->hasMany(Trabajo::class);
    }
public function integrantes()
{
    return $this->hasMany(Integrante::class, 'proyecto_id');
}
}
