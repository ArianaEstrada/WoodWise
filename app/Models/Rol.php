<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\RolFactory;
class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $primaryKey = 'id_rol';

    protected $fillable = [
        'nom_rol',
        'desc_rol',
    ];
}
