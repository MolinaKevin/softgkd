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
            'description' => 'Clientes comunes del sitio',
        ]);
        DB::table('roles')->insert([
            'name' => 'Administracion',
            'description' => 'Administradores',
        ]);
    }
}
