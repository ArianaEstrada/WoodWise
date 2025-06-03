<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productor extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'productores';

    // Clave primaria personalizada
    protected $primaryKey = 'id_productor';

    // Auto-incremento y timestamps
    public $incrementing = true;
    public $timestamps = true;

    // Campos asignables masivamente
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
}
