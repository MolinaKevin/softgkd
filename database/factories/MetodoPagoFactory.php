<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MetodoPago;
use Faker\Generator as Faker;

$factory->define(MetodoPago::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
        'cash' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
