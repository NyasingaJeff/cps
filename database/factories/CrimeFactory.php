<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Crime;
use Faker\Generator as Faker;

$factory->define(Crime::class, function (Faker $faker) {
    return [
        "name"=>$faker->word,
        "description"=>$faker->unique()->e164PhoneNumber,
        "fine"=>$faker->numberBetween($min = 1000, $max = 3000 )
    ];
});
