<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Persona;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Rol;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard1';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    protected function redirectTo()
    {
        return '/dashboard1';
    }
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function showRegistrationForm()
    {
        $roles = Rol::where('nom_rol', '!=', 'Administrador')->get(); // Filtra el rol "administrador"
        return view('auth.register', compact('roles'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nom' => ['required', 'string', 'max:255'],
            'ap' => ['required', 'string', 'max:255'],
            'am' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:personas,correo'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cedula' => ['nullable', 'string', 'min:5'], // Validación de cédula
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
    // Verificar que 'id_rol' existe y es válido
    if (!isset($data['id_rol']) || empty($data['id_rol'])) {
        throw new \Exception('El campo id_rol es obligatorio.');
    }

    // Obtener el rol
    $rol = Rol::find($data['id_rol']);

    // Validar que el rol exista
    if (!$rol) {
        throw new \Exception('El rol seleccionado no es válido.');
    }

    // Crear la persona
    $persona = Persona::create([
        'nom' => $data['nom'],
        'ap' => $data['ap'],
        'am' => $data['am'],
        'telefono' => $data['telefono'],
        'correo' => $data['email'],
        'contrasena' => Hash::make($data['password']),
        'id_rol' => (int)$data['id_rol'], // 🔥 Convertir a entero por seguridad
        'cedula' => $data['cedula'] ?? null, // Si la cédula es proporcionada, se almacena
    ]);

    // Registrar en la tabla correspondiente según el rol
    if ($rol->nom_rol === 'Técnico') {
        // Generar una clave de técnico única de 8 dígitos alfanuméricos
        do {
            $clave_tecnico = strtoupper(str_random(8)); // Generar una clave aleatoria de 8 caracteres
        } while (Tecnico::where('clave_tecnico', $clave_tecnico)->exists()); // Verificar si ya existe la clave en la base de datos

        // Registrar en la tabla de técnicos
        $tecnico = Tecnico::create([
            'id_persona' => $persona->id_persona,
            'cedula_p' => $data['cedula'] ?? null,  // Asignar cédula si la tienes
            'clave_tecnico' => $clave_tecnico, // Asignar la clave generada
        ]);
    } elseif ($rol->nom_rol === 'Productor') {
        // Registrar en la tabla de productores
        $productor = Productor::create([
            'id_persona' => $persona->id_persona,
        ]);
    }

    // Crear el usuario relacionado con la persona
    return User::create([
        'name' => $data['nom'] . ' ' . $data['ap'] . ' ' . $data['am'],  // Asignar el nombre completo
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'id_persona' => $persona->id_persona,
    ]);
}


    // Método para confirmar la cédula (ya no será necesario)
    // public function confirmarCedula(Request $request) { ... }
}
