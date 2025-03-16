<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Turno_Corta extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla (si no es el plural de la clase)
    protected $table = 'turno_cortas';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'id_turno';

    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = [
        'id_parcela',
        'codigo_corta',
        'fecha_corta',
    ];

    // Relación con la tabla 'parcelas'
    public function parcela()
    {
        return $this->belongsTo(Parcela::class, 'id_parcela');
    }

    // Si la clave primaria no es auto-incrementable
    public $incrementing = true;

    // Si no estás utilizando las marcas de tiempo (created_at y updated_at)
    public $timestamps = false;
}
