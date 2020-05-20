<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Hospital;
use Faker\Generator as Faker;

$factory->define(Hospital::class, function (Faker $faker) {
    return [
          'name' => $faker->company,
          'address' => $faker->streetAddress,
    ];
});
