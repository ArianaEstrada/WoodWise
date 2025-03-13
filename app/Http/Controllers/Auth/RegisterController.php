<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Persona;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Rol;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
    
        // Si el rol es "Técnico", redirigir a la página de validación de cédula
        if ($rol->nom_rol === 'Técnico') {
            session(['pending_registration' => $data]);
            return redirect()->route('validar.cedula');
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
        ]);
    
        // Crear el usuario relacionado con la persona
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id_persona' => $persona->id_persona,
        ]);
    }
    
    public function confirmarCedula(Request $request)
{
    $request->validate([
        'cedula' => 'required|string|min:5',
    ]);

    $cedula = $request->cedula;

    // Consulta a la API del Gobierno para verificar la cédula
    $response = Http::get("https://api.gob.mx/cedula-profesional/{$cedula}");

    // Verificar si la cédula es válida
    if ($response->successful() && $response->json('valido')) {
        $data = session('pending_registration');

        // Crear la persona
        $persona = Persona::create([
            'nom' => $data['nom'],
            'ap' => $data['ap'],
            'am' => $data['am'],
            'telefono' => $data['telefono'],
            'correo' => $data['email'],
            'contrasena' => Hash::make($data['password']),
            'id_rol' => 3, // ID del rol Técnico
            'cedula' => $cedula, // Guardar la cédula validada
        ]);

        // Crear el usuario
        User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id_persona' => $persona->id_persona,
        ]);

        // Limpiar la sesión temporal
        session()->forget('pending_registration');

        return redirect('/dashboard')->with('success', 'Registro completado exitosamente.');
    }

    return back()->with('error', 'La Cédula Profesional no es válida o hubo un error en la verificación.');
}


}
