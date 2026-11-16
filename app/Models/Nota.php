<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nota extends Model
{
    use SoftDeletes; // Trait, conjunto associado de métodos, para habilitar soft delete no model
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
