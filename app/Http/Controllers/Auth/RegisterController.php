<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\{User, Persona, Tecnico, Productor, Rol};
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get the post-registration redirect path.
     *
     * @return string
     */
    protected function redirectTo()
    {
        if (auth()->check() && auth()->user()->persona) {
            $rol = auth()->user()->persona->rol->nom_rol;
            
            switch ($rol) {
                case 'Tecnico':
                    return route('tecnico.dashboard');
                case 'Productor':
                    return route('productor.dashboard');
                default:
                    return '/dashboard1';
            }
        }
        return '/dashboard1';
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $roles = Rol::where('nom_rol', '!=', 'Administrador')->get();
        return view('auth.register', compact('roles'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nom' => ['required', 'string', 'max:255'],
            'ap' => ['required', 'string', 'max:255'],
            'am' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:personas,correo'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cedula' => ['nullable', 'string', 'min:5'],
            'id_rol' => ['required', 'exists:roles,id_rol'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $rol = Rol::findOrFail($data['id_rol']);

        // Crear persona
        $persona = Persona::create([
            'nom' => $data['nom'],
            'ap' => $data['ap'],
            'am' => $data['am'],
            'telefono' => $data['telefono'],
            'correo' => $data['email'],
            'contrasena' => Hash::make($data['password']),
            'id_rol' => $rol->id_rol,
            'cedula' => $data['cedula'] ?? null,
        ]);

        // Registrar según el rol
        switch ($rol->nom_rol) {
            case 'Tecnico':
                Tecnico::create([
                    'id_persona' => $persona->id_persona,
                    'cedula_p' => $data['cedula'] ?? null,
                ]);
                break;
                
            case 'Productor':
                Productor::create([
                    'id_persona' => $persona->id_persona,
                ]);
                break;
        }

        // Crear usuario
        return User::create([
            'name' => "{$data['nom']} {$data['ap']} {$data['am']}",
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id_persona' => $persona->id_persona,
        ]);
    }

    /**
     * Generate unique técnico code
     * 
     * @return string
     */
    protected function generateTecnicoCode()
    {
        do {
            $code = strtoupper(Str::random(8));
        } while (Tecnico::where('clave_tecnico', $code)->exists());

        return $code;
    }
}