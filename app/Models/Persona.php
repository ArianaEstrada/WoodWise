<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';
    protected $primaryKey = 'id_persona';

    protected $fillable = ['nom', 'ap', 'am', 'telefono', 'correo', 'contrasena', 'id_rol'];
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class, 'id_persona');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }
    
}

