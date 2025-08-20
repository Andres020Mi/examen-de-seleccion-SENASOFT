<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class semillero extends Model
{
    protected $table = "semilleros";

    protected $fillable = [
        "name",
        "description"
    ];


}
