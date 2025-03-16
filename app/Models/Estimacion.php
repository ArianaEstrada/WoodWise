<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimacion extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla (si no es el plural de la clase)
    protected $table = 'estimaciones';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'id_estimacion';

    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = [
        'id_tipo_e',
        'id_formula',
        'calculo',
        'id_troza',
    ];

    // Relación con la tabla 'tipo_estimaciones'
    public function tipoEstimacion()
    {
        return $this->belongsTo(TipoEstimacion::class, 'id_tipo_e');
    }

    // Relación con la tabla 'formulas'
    public function formula()
    {
        return $this->belongsTo(Formula::class, 'id_formula');
    }

    // Relación con la tabla 'trozas'
    public function troza()
    {
        return $this->belongsTo(Troza::class, 'id_troza');
    }

    // Si la clave primaria no es auto-incrementable
    public $incrementing = true;

    // Si no estás utilizando las marcas de tiempo (created_at y updated_at)
    public $timestamps = false;
}
