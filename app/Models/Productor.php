<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productor extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla (si no es el plural de la clase)
    protected $table = 'productores';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'id_productor';

    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = [
        'id_persona',
    ];

    // Relación con la tabla 'personas'
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    // Relación con la tabla 'parcelas'
    public function parcelas()
    {
        return $this->hasMany(Parcela::class, 'id_productor');
    }

    // Si la clave primaria no es auto-incrementable
    public $incrementing = true;

    // Si no estás utilizando las marcas de tiempo (created_at y updated_at)
    public $timestamps = false;
}
