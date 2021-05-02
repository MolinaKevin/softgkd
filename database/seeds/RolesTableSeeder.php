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
            'descripcion' => 'Clientes comunes del sitio',
            'estado' => true
        ]);
        DB::table('roles')->insert([
            'name' => 'Administracion',
            'descripcion' => 'Administradores',
            'estado' => true
        ]);
    }
}
