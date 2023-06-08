<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Cierre;
use Faker\Generator as Faker;

$factory->define(Cierre::class, function (Faker $faker) {

    return [
        'at' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
