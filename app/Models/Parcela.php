<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla (si no es el plural de la clase)
    protected $table = 'parcelas';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'id_parcela';

    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = [
        'nom_parcela',
        'ubicacion',
        'id_productor',
        'extension',
        'direccion',
        'CP',
    ];

    // Relación con la tabla 'productores'
    public function productor()
    {
        return $this->belongsTo(Productor::class, 'id_productor');
    }
    public function tecnicos()
    {
        return $this->belongsToMany(Tecnico::class, 'asigna_parcelas', 'id_parcela', 'id_tecnico');
    }

    public function trozas()
    {
        return $this->hasMany(Troza::class, 'id_parcela');
    }

    // Si la clave primaria no es auto-incrementable
    public $incrementing = true;

    // Si no estás utilizando las marcas de tiempo (created_at y updated_at)
    public $timestamps = true; // Si no usas created_at/updated_at
    protected $dates = [
        'created_at',
        'updated_at'
    ];}
