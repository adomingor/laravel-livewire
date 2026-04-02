<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar caché de permisos
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // --- Permisos ---
        $permisos = [
            // Productos
            'ver productos',
            'crear productos',
            'editar productos',
            'eliminar productos',

            // Categorías
            'ver categorias',
            'crear categorias',
            'editar categorias',
            'eliminar categorias',

            // Pruebas
            'ver pruebas',
            'crear pruebas',
            'editar pruebas',
            'eliminar pruebas',

            // Usuarios
            'ver usuarios',
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios',

            // Roles y permisos
            'ver roles',
            'crear roles',
            'editar roles',
            'eliminar roles',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso, 'guard_name' => 'web']);
        }

        // --- Roles ---

        // Admin: acceso total
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions(Permission::all());

        // Editor: puede ver, crear y editar (no eliminar ni gestionar usuarios/roles)
        $editor = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);
        $editor->syncPermissions([
            'ver productos', 'crear productos', 'editar productos',
            'ver categorias', 'crear categorias', 'editar categorias',
            'ver pruebas', 'crear pruebas', 'editar pruebas',
        ]);

        // Viewer: solo lectura
        $viewer = Role::firstOrCreate(['name' => 'viewer', 'guard_name' => 'web']);
        $viewer->syncPermissions([
            'ver productos',
            'ver categorias',
            'ver pruebas',
        ]);

        $this->command->info('Roles y permisos creados correctamente.');
    }
}
