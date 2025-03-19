<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // 1. Crear o obtener el rol de Administrador
        $adminRol = Rol::firstOrCreate(
            ['nom_rol' => 'Administrador'],
            ['descripcion' => 'Rol con acceso total al sistema']
        );

        // 2. Crear la persona administradora
        $personaAdmin = Persona::create([
            'nom' => 'Admin',
            'ap' => 'Sistema',
            'am' => 'Principal',
            'telefono' => '0000000000',
            'correo' => 'admin@empresa.com',
            'contrasena' => Hash::make('AdminPassword123!'), // Contraseña segura
            'id_rol' => $adminRol->id_rol,
            
        ]);

        // 3. Crear el usuario de autenticación
        User::create([
            'name' => 'Administrador del Sistema',
            'email' => 'admin@empresa.com',
            'password' => Hash::make('AdminPassword123!'),
            'id_persona' => $personaAdmin->id_persona
        ]);

        $this->command->info('✅ Usuario administrador creado exitosamente!');
        $this->command->info('📧 Email: admin@empresa.com');
        $this->command->info('🔑 Contraseña: AdminPassword123!');
    }
}
