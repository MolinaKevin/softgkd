<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(App\Models\User::class)->create([
            'email' => 'soft@gkd.com',
            'password' => 'DavidH4P',
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'dni' => '36000000',
            'sexo' => 'masculino',
            'direccion' => 'prueba ',
            'telefono' => '00000000',
            'celular' => '00000000',
            'fecha_nacimiento' => Carbon::parse('2000-01-01'),
        ]);
        $user->roles()->attach(\App\Models\Role::find(2));


    }
}
