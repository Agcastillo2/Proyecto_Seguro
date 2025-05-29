<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $secre = Role::create(['name' => 'secre']);
        $bodega = Role::create(['name' => 'bodega']);
        $cajera = Role::create(['name' => 'cajera']);

        Permission::create(['name' => 'crear usuarios']);
        Permission::create(['name' => 'ver usuarios']);
        Permission::create(['name' => 'crear categorias']);
        Permission::create(['name' => 'listar categorias']);
        Permission::create(['name' => 'crear productos']);
        Permission::create(['name' => 'listar productos']);
        Permission::create(['name' => 'crear ventas']);
        Permission::create(['name' => 'ver ventas propias']);

        $admin->givePermissionTo(['crear usuarios', 'ver usuarios']);
        $secre->givePermissionTo(['crear usuarios', 'ver usuarios']);
        $bodega->givePermissionTo([
            'crear categorias',
            'listar categorias',
            'crear productos',
            'listar productos'
        ]);
        $cajera->givePermissionTo([
            'crear ventas',
            'ver ventas propias'
        ]);

        //crear usuario admin

        $adminUser = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123')
        ]);
        $adminUser->assignRole('admin');
    }
}
