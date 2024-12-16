<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // Crear los permisos
        $permissions = [

            // Permisos de dashboard
            'admin.dashboard',
            'coordinador.dashboard',
            'usuario.dashboard',

            // Permisos para "region"
            'region.index',
            'region.create',
            'region.show',
            'region.edit',
            'region.destroy',

            // Permisos para "delegacion"
            'delegacion.index',
            'delegacion.create',
            'delegacion.show',
            'delegacion.edit',
            'delegacion.destroy',

            // Permisos para "user"
            'user.index',
            'user.create',
            'user.show',
            'user.edit',
            'user.destroy',

            // Permisos para "role"
            'role.index',
            'role.create',
            'role.show',
            'role.edit',
            'role.destroy',

            // Permisos para "permission"
            'permission.index',
            'permission.create',
            'permission.show',
            'permission.edit',
            'permission.destroy',

            // Permisos para "coordinador"
            'coordinador.index',
            'coordinador.create',
            'coordinador.show',
            'coordinador.edit',
            'coordinador.destroy',

            // Permisos para "usuario"
            'usuario.index',
            'usuario.create',
            'usuario.show',
            'usuario.edit',
            'usuario.destroy',
        ];

        // Crear los permisos en la base de datos
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Crear los roles
        $roles = [
            'Administrador' => [
                'admin.dashboard',
                'region.index', 'region.create', 'region.show', 'region.edit', 'region.destroy',
                'delegacion.index', 'delegacion.create', 'delegacion.show', 'delegacion.edit', 'delegacion.destroy',
                'user.index', 'user.create', 'user.show', 'user.edit', 'user.destroy',
                'role.index', 'role.create', 'role.show', 'role.edit', 'role.destroy',
                'permission.index', 'permission.create', 'permission.show', 'permission.edit', 'permission.destroy',
                'usuario.index', 'usuario.create', 'usuario.show', 'usuario.edit', 'usuario.destroy',
                'coordinador.index', 'coordinador.create', 'coordinador.show', 'coordinador.edit', 'coordinador.destroy',
            ],
            'Coordinador' => [
                'coordinador.dashboard',
                'coordinador.index', 'coordinador.create', 'coordinador.show', 'coordinador.edit', 'coordinador.destroy',
            ],
            'Usuario' => [
                'usuario.dashboard',
                'usuario.index', 'usuario.create', 'usuario.show', 'usuario.edit', 'usuario.destroy',
            ]
        ];

        // Crear los roles y asignar permisos
        foreach ($roles as $roleName => $rolePermissions) {
            // Crear el rol
            $role = Role::create(['name' => $roleName]);

            // Asignar permisos al rol
            $role->givePermissionTo($rolePermissions);
        }

        // Asignar el rol "Administrador" al usuario con ID 1
        $user = User::find(1); // Busca al usuario con ID 1

        if ($user) {
            // Asigna el rol de Administrador
            $user->assignRole('Administrador');
            
            // También, puedes asignar permisos específicos si es necesario
            // $user->givePermissionTo('region.index', 'region.create');
        }        
    }
}
