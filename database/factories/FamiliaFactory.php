<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Familia::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
