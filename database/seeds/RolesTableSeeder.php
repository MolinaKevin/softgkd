<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Cliente',
            'display_name' => null,
            'descripcion' => 'Clientes comunes del sitio',
            'estado' => true
        ]);
        DB::table('roles')->insert([
            'name' => 'Administracion',
            'display_name' => 'admin',
            'descripcion' => 'Administradores',
            'estado' => true
        ]);
    }
}
