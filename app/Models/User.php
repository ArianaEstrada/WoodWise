<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'id_persona',
    ];

    protected $hidden = ['password', 'remember_token'];
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    public function getRolIdAttribute()
    {
        return $this->persona ? $this->persona->id_rol : null;
    }
    public $timestamps = true; // Si no usas created_at/updated_at
    public $incrementing = true;


}

