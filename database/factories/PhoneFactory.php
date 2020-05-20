<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Phone;
use App\User;
use Faker\Generator as Faker;

$factory->define(Phone::class, function (Faker $faker) {
    return [
        'phone'=>$faker->unique()->phoneNumber,
        'code'=>$faker->randomNumber(3),
    ];
});
