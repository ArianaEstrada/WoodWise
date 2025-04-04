<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Troza extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla (si no es el plural de la clase)
    protected $table = 'trozas';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'id_troza';

    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = [
        'longitud',
        'diametro',
        'densidad',
        'id_especie',
        'id_parcela',
    ];

    // Relación con la tabla 'especies'
    public function especie()
    {
        return $this->belongsTo(Especie::class, 'id_especie');
    }

    // Relación con la tabla 'parcelas'
    public function parcela()
    {
        return $this->belongsTo(Parcela::class, 'id_parcela');
    }
    public function formula()
{
    return $this->belongsTo(Formula::class, 'id_formula');
}
    // Si la clave primaria no es auto-incrementable
    public $incrementing = true;

    // Si no estás utilizando las marcas de tiempo (created_at y updated_at)
    public $timestamps = false;
    public function getDiametroCmAttribute()
    {
        return $this->diametro * 100;
    }

    // Método de acceso para mostrar longitud en cm (opcional)
    public function getLongitudCmAttribute()
    {
        return $this->longitud * 100;
    }

}
