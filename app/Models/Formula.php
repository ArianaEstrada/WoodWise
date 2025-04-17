<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla (si no es el plural de la clase)
    protected $table = 'formulas';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'id_formula';

    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = [
        'nom_formula',
        'expresion',
    ];
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    // Si la clave primaria no es auto-incrementable
    public $incrementing = true;

    // Si no estás utilizando las marcas de tiempo (created_at y updated_at)
    public $timestamps = false;
}
