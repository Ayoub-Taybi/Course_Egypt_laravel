<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Offer;
use Faker\Generator as Faker;

$factory->define(Offer::class, function (Faker $faker) {
    


    $data_en = [
                'name_en' => $faker->name,
                'price' => $faker->unique()->numberBetween(100, 200),
                'details_en' => $faker->realText(),
    ];

      // this ligne of code it gonna be change the language faker from english to arabic

    $faker = \Faker\Factory::create('ar_SA');

    $data_ar =  [
        'name_ar' => $faker->name,       
        'details_ar' => $faker->realText(),
    ];

       return array_merge($data_en,$data_ar);


});
