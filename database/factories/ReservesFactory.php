<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reserve;

use Faker\Generator as Faker;
$factory->define(Reserve::class, function (Faker $faker) {
    $space = \App\Space::inRandomOrder()->first();
    return [
       "space_id"=>$space->id,
       "email"=>$faker->email,
       "duration"=> $faker->randomNumber($min = 4 ),
       "organisation"=>$faker->company
    ];
});