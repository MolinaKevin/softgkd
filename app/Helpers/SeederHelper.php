<?php

namespace App\Helpers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SeederHelper {

    public static function user($name)
    {
        $tmpName = $name;
        $names = explode(' ', $name);
        $last_space_position = strrpos($tmpName, ' ');
        $last_name = substr($tmpName, 0, $last_space_position);
        $first_name = array_pop($names);

        $mail = str_replace(' ', '', $last_name) . '.' . str_replace(' ', '', $first_name). '@gkd.com';

        $dni = 36000000 + rand(0, 299999) + rand(0, 299999) + rand(0, 299999);

        $user = factory(User::class)->create([
            'email' => $mail,
            'password' => 'secret',
            'first_name' => $first_name,
            'last_name' => $last_name,
            'dni' => '36000000',
            'sexo' => 'masculino',
            'direccion' => 'nuevo usuario',
            'telefono' => '00000000',
            'celular' => '00000000',
            'fecha_nacimiento' => Carbon::parse('2000-01-01'),
        ]);

        $user->roles()->attach(\App\Models\Role::find(1));

    }
}