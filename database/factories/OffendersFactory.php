<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Offender;
use Faker\Generator as Faker;

$factory->define(Offender::class, function (Faker $faker) {
    $record = \App\Record::inRandomOrder()->first();
    $crime =  \App\Crime::inRandomOrder()->first();
    return [
        "no_plate"=>$record->no_plate,
        "location"=>$record->space->location,
        "make"=>$faker->randomElement(['Toyota','Mercedees','B.M.W']),
        "model"=>$faker->randomElement(['S.U.V','Saloon','Other']),
        "color"=>$faker->randomElement(['Red','Blue','Black']),
        "crime_id"=>$crime->id,
        "fine_due"=>$crime->id,
        "status"=>0
    ];
});
