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
        'email',
        'password',
        'id_persona',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
    
}

