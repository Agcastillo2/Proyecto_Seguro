<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos
        Permission::create(['name' => 'crear usuarios']);
        Permission::create(['name' => 'ver usuarios']);
        Permission::create(['name' => 'crear categorias']);
        Permission::create(['name' => 'listar categorias']);
        Permission::create(['name' => 'crear productos']);
        Permission::create(['name' => 'listar productos']);
        Permission::create(['name' => 'crear ventas']);
        Permission::create(['name' => 'ver ventas propias']);

        // Crear roles y asignar permisos
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(['crear usuarios', 'ver usuarios']);

        $secre = Role::create(['name' => 'secre']);
        $secre->givePermissionTo(['crear usuarios', 'ver usuarios']);

        $bodega = Role::create(['name' => 'bodega']);
        $bodega->givePermissionTo([
            'crear categorias',
            'listar categorias',
            'crear productos',
            'listar productos'
        ]);

        $cajera = Role::create(['name' => 'cajera']);
        $cajera->givePermissionTo([
            'crear ventas',
            'ver ventas propias'
        ]);
    }
}
