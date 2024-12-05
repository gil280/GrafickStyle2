<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administrador = Role::create(['name'=> 'Administrador']);
        $editor = Role::create(['name'=> 'Editor']);
        $usuario = Role::create(['name'=> 'Usuario']);

        Permission::create(['name' => 'Crear'])->syncRoles([$administrador ]);
        Permission::create(['name' => 'Actualizar'])->syncRoles([$administrador, $editor ]);
        Permission::create(['name' => 'ver'])->syncRoles([$administrador, $editor, $usuario ]);
        Permission::create(['name' => 'Eliminar'])->syncRoles([$administrador ]);

    }
}
