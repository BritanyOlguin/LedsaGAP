<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles
        $role_admin = Role::create(['name' => 'admin']);
        $role_RH = Role::create(['name' => 'RH']);
        $role_personal = Role::create(['name' => 'personal']);
        $role_prospecto = Role::create(['name' => 'prospecto']);

        // Rol
        $permission_crear_rol = Permission::create(['name' => 'crear rol']);
        $permission_leer_rol = Permission::create(['name' => 'leer rol']);
        $permission_actualizar_rol = Permission::create(['name' => 'actualizar rol']);
        $permission_eliminar_rol = Permission::create(['name' => 'eliminar rol']);

        // Usuarios
        $permission_crear_usuario = Permission::create(['name' => 'crear usuario']);
        $permission_leer_usuario = Permission::create(['name' => 'leer usuario']);
        $permission_actualizar_usuario = Permission::create(['name' => 'actualizar usuario']);
        $permission_eliminar_usuario = Permission::create(['name' => 'eliminar usuario']);

        // Carpetas
        $permission_crear_carpeta = Permission::create(['name' => 'crear carpeta']);
        $permission_leer_carpeta = Permission::create(['name' => 'leer carpeta']);
        $permission_actualizar_carpeta = Permission::create(['name' => 'actualizar carpeta']);
        $permission_eliminar_carpeta = Permission::create(['name' => 'eliminar carpeta']);

        // Archivos del personal
        $permission_subir_archivos = Permission::create(['name' => 'subir archivos']);
        $permission_leer_archivos = Permission::create(['name' => 'leer archivos']);
        $permission_descargar_archivos = Permission::create(['name' => 'descargar archivos']);
        $permission_eliminar_archivos = Permission::create(['name' => 'eliminar archivos']);

        // Consultas o buscar
        $permission_consultar = Permission::create(['name' => 'consultar']);

        // Mis documentos
        $permission_subir_mis_documentos = Permission::create(['name' => 'subir mis documentos']);
        $permission_leer_mis_documentos = Permission::create(['name' => 'leer mis documentos']);
        $permission_descargar_mis_documentos = Permission::create(['name' => 'descargar mis documentos']);
        $permission_eliminar_mis_documentos = Permission::create(['name' => 'eliminar mis documentos']);

        // Array de permisos
        $permissions_admin = [
            $permission_crear_rol,
            $permission_leer_rol,
            $permission_actualizar_rol,
            $permission_eliminar_rol,
            $permission_crear_usuario,
            $permission_leer_usuario,
            $permission_actualizar_usuario,
            $permission_eliminar_usuario,
            $permission_crear_carpeta,
            $permission_leer_carpeta,
            $permission_actualizar_carpeta,
            $permission_eliminar_carpeta,
            $permission_subir_archivos,
            $permission_leer_archivos,
            $permission_descargar_archivos,
            $permission_eliminar_archivos,
            $permission_consultar
        ];

        $permissions_RH = [
            $permission_crear_carpeta,
            $permission_leer_carpeta,
            $permission_actualizar_carpeta,
            $permission_eliminar_carpeta,
            $permission_subir_archivos,
            $permission_leer_archivos,
            $permission_descargar_archivos,
            $permission_eliminar_archivos,
            $permission_consultar
        ];

        $permissions_personal = [
            $permission_subir_mis_documentos,
            $permission_leer_mis_documentos,
            $permission_descargar_mis_documentos,
            $permission_leer_carpeta
        ];

        $permissions_prospecto = [
            $permission_crear_carpeta,
            $permission_leer_carpeta,
            $permission_actualizar_carpeta,
            $permission_subir_mis_documentos,
            $permission_leer_mis_documentos,
            $permission_eliminar_mis_documentos,
            $permission_descargar_mis_documentos
        ];

        // Asignar permisos a roles
        $role_admin->syncPermissions($permissions_admin);
        $role_RH->syncPermissions($permissions_RH);
        $role_personal->syncPermissions($permissions_personal);
        $role_prospecto->syncPermissions($permissions_prospecto);
    }
}
