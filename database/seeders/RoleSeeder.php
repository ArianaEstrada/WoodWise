<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'nom_rol' => 'Administrador',
            'desc_rol' => 'Rol con permisos completos en el sistema.',
        ]);

        Role::create([
            'nom_rol' => 'Productor',
            'desc_rol' => 'Rol con permisos para gestionar la producción.',
        ]);

        Role::create([
            'nom_rol' => 'Técnico',
            'desc_rol' => 'Rol con permisos para gestionar mantenimiento y soporte.',
        ]);
    }
}
