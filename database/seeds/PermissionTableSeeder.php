<?php

use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Roles
        Permission::create([
            'name'          => 'Navegar roles',
            'slug'          => 'roles.index',
            'description'   => 'Lista y navega todos los roles del sistema',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de un rol',
            'slug'          => 'roles.show',
            'description'   => 'Ve en detalle cada rol del sistema',
        ]);

        Permission::create([
            'name'          => 'Creación de roles',
            'slug'          => 'roles.create',
            'description'   => 'Podría crear nuevos roles en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de roles',
            'slug'          => 'roles.edit',
            'description'   => 'Podría editar cualquier dato de un rol del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar roles',
            'slug'          => 'roles.destroy',
            'description'   => 'Podría eliminar cualquier rol del sistema',
        ]);

        //Usuario
        Permission::create([
            'name'          => 'Navegar usuarios',
            'slug'          => 'users.index',
            'description'   => 'Lista y navega todos los usuarios del sistema',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de un usuario',
            'slug'          => 'users.show',
            'description'   => 'Ve en detalle cada usuario del sistema',
        ]);

        Permission::create([
            'name'          => 'Creación de usuarios',
            'slug'          => 'users.create',
            'description'   => 'Podría crear nuevos usuarios en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de usuarios',
            'slug'          => 'users.edit',
            'description'   => 'Podría editar cualquier dato de un usuario del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar usuarios',
            'slug'          => 'users.destroy',
            'description'   => 'Podría eliminar cualquier usuario del sistema',
        ]);

        //Grupos
        Permission::create([
            'name'          => 'Navegar grupos',
            'slug'          => 'familias.index',
            'description'   => 'Lista y navega todos los grupos del sistema',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de un grupo',
            'slug'          => 'familias.show',
            'description'   => 'Ve en detalle cada grupo del sistema',
        ]);

        Permission::create([
            'name'          => 'Creación de grupos',
            'slug'          => 'familias.create',
            'description'   => 'Podría crear nuevos grupos en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de grupos',
            'slug'          => 'familias.edit',
            'description'   => 'Podría editar cualquier dato de un grupo del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar grupos',
            'slug'          => 'familias.destroy',
            'description'   => 'Podría eliminar cualquier grupo del sistema',
        ]);

        //Planes
        Permission::create([
            'name'          => 'Navegar planes',
            'slug'          => 'plans.index',
            'description'   => 'Lista y navega todos los planes del sistema',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de un plan',
            'slug'          => 'plans.show',
            'description'   => 'Ve en detalle cada plan del sistema',
        ]);

        Permission::create([
            'name'          => 'Creación de planes',
            'slug'          => 'plans.create',
            'description'   => 'Podría crear nuevos planes en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de planes',
            'slug'          => 'plans.edit',
            'description'   => 'Podría editar cualquier dato de un plan del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar planes',
            'slug'          => 'plans.destroy',
            'description'   => 'Podría eliminar cualquier plan del sistema',
        ]);

        //Planes Especiales
        Permission::create([
            'name'          => 'Navegar planes especiales',
            'slug'          => 'especials.index',
            'description'   => 'Lista y navega todos los planes especiales del sistema',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de un plan especial',
            'slug'          => 'especials.show',
            'description'   => 'Ve en detalle cada plan especial del sistema',
        ]);

        Permission::create([
            'name'          => 'Creación de planes especiales',
            'slug'          => 'especials.create',
            'description'   => 'Podría crear nuevos planes especiales en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de planes especiales',
            'slug'          => 'especials.edit',
            'description'   => 'Podría editar cualquier dato de un plan especial del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar planes especiales',
            'slug'          => 'especials.destroy',
            'description'   => 'Podría eliminar cualquier plan especial del sistema',
        ]);

        //Revisiones
        Permission::create([
            'name'          => 'Navegar revisaciones',
            'slug'          => 'revisacions.index',
            'description'   => 'Lista y navega todas las revisaciones del sistema',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de un revisación',
            'slug'          => 'revisacions.show',
            'description'   => 'Ve en detalle cada revisación del sistema',
        ]);

        Permission::create([
            'name'          => 'Creación de revisaciones',
            'slug'          => 'revisacions.create',
            'description'   => 'Podría crear nuevos revisaciones en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de revisaciones',
            'slug'          => 'revisacions.edit',
            'description'   => 'Podría editar cualquier dato de un revisación del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar revisaciones',
            'slug'          => 'revisacions.destroy',
            'description'   => 'Podría eliminar cualquier revisación del sistema',
        ]);

        //Deudas
        Permission::create([
            'name'          => 'Navegar deudas',
            'slug'          => 'deudas.index',
            'description'   => 'Lista y navega todos los deudas del sistema',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de un deuda',
            'slug'          => 'deudas.show',
            'description'   => 'Ve en detalle cada deuda del sistema',
        ]);

        Permission::create([
            'name'          => 'Creación de deudas',
            'slug'          => 'deudas.create',
            'description'   => 'Podría crear nuevas deudas en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de deudas',
            'slug'          => 'deudas.edit',
            'description'   => 'Podría editar cualquier dato de un deuda del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar deudas',
            'slug'          => 'deudas.destroy',
            'description'   => 'Podría eliminar cualquier deuda del sistema',
        ]);

        //Pagos
        Permission::create([
            'name'          => 'Navegar pagos',
            'slug'          => 'pagos.index',
            'description'   => 'Lista y navega todos los pagos del sistema',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de un pago',
            'slug'          => 'pagos.show',
            'description'   => 'Ve en detalle cada pago del sistema',
        ]);

        Permission::create([
            'name'          => 'Creación de pagos',
            'slug'          => 'pagos.create',
            'description'   => 'Podría crear nuevos pagos en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de pagos',
            'slug'          => 'pagos.edit',
            'description'   => 'Podría editar cualquier dato de un pago del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar pagos',
            'slug'          => 'pagos.destroy',
            'description'   => 'Podría eliminar cualquier pago del sistema',
        ]);

        //Horarios
        Permission::create([
            'name'          => 'Navegar horarios',
            'slug'          => 'horarios.index',
            'description'   => 'Lista y navega todos los horarios del sistema',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de un horario',
            'slug'          => 'horarios.show',
            'description'   => 'Ve en detalle cada horario del sistema',
        ]);

        Permission::create([
            'name'          => 'Creación de horarios',
            'slug'          => 'horarios.create',
            'description'   => 'Podría crear nuevos horarios en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de horarios',
            'slug'          => 'horarios.edit',
            'description'   => 'Podría editar cualquier dato de un horario del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar horarios',
            'slug'          => 'horarios.destroy',
            'description'   => 'Podría eliminar cualquier horario del sistema',
        ]);

        //Asistencias
        Permission::create([
            'name'          => 'Navegar asistencias',
            'slug'          => 'asistencias.index',
            'description'   => 'Lista y navega todos los asistencias del sistema',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de un asistencia',
            'slug'          => 'asistencias.show',
            'description'   => 'Ve en detalle cada asistencia del sistema',
        ]);

        Permission::create([
            'name'          => 'Creación de asistencias',
            'slug'          => 'asistencias.create',
            'description'   => 'Podría crear nuevos asistencias en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de asistencias',
            'slug'          => 'asistencias.edit',
            'description'   => 'Podría editar cualquier dato de un asistencia del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar asistencias',
            'slug'          => 'asistencias.destroy',
            'description'   => 'Podría eliminar cualquier asistencia del sistema',
        ]);

        //Dispositivos
        Permission::create([
            'name'          => 'Navegar dispositivos',
            'slug'          => 'dispositivos.index',
            'description'   => 'Lista y navega todos los dispositivos del sistema',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de un dispositivo',
            'slug'          => 'dispositivos.show',
            'description'   => 'Ve en detalle cada dispositivo del sistema',
        ]);

        Permission::create([
            'name'          => 'Creación de dispositivos',
            'slug'          => 'dispositivos.create',
            'description'   => 'Podría crear nuevos dispositivos en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de dispositivos',
            'slug'          => 'dispositivos.edit',
            'description'   => 'Podría editar cualquier dato de un dispositivo del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar dispositivos',
            'slug'          => 'dispositivos.destroy',
            'description'   => 'Podría eliminar cualquier dispositivo del sistema',
        ]);
    }
}
