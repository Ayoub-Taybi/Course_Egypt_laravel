<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Patient;
use App\Models\Medical;
use Faker\Generator as Faker;

$factory->define(Patient::class, function (Faker $faker) {
    return [
           'name'=>$faker->name,
           'age' => $faker->numberBetween($min = 16, $max = 120),

    ];
});


$factory->afterCreating(Patient::class, function ($patient, $faker) {
    $patient->medical()->save(factory(Medical::class)->make());
});

