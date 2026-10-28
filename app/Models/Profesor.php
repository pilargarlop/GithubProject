<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $table = 'profesor';

    protected $fillable = [
        'nombre',
        'apellido',
        'especialidad',
        'falta',
        'salario',
    ];
}