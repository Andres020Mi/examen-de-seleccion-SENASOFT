<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
     use HasFactory;

    protected $fillable = [
        'user_id',
        'descripcion',
        'proyecto_id', // ⚡ si decides agregarlo
    ];

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
