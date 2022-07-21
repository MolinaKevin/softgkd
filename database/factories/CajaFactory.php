<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Caja;
use Faker\Generator as Faker;

$factory->define(Caja::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'cerrado' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
