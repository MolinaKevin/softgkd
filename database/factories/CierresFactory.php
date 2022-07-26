<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Cierres;
use Faker\Generator as Faker;

$factory->define(Cierres::class, function (Faker $faker) {

    return [
        'at' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
