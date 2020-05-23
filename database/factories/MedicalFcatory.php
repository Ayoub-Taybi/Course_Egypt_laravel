<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Medical;
use Faker\Generator as Faker;


$factory->define(Medical::class, function (Faker $faker) {
    return [
          'pdf'=>$faker->name.".pdf",
    ];
});


