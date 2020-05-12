<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Offer;
use Faker\Generator as Faker;

$factory->define(Offer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->unique()->numberBetween(100, 200),
        'details' => $faker->text,
    ];
});
