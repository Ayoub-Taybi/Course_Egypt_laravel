<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Doctor;
use Faker\Generator as Faker;


$factory->define(Doctor::class, function (Faker $faker) {

    $gender = $faker->randomElement(['male', 'female']);

    return [
        'name' => $faker->name($gender),
        'title' => $faker->jobTitle,
        'sex' => $gender,
    ];

});






