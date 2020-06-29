<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Record;
use Faker\Generator as Faker;



$factory->define(Record::class, function (Faker $faker) {
$client = \App\clients::inRandomOrder()->first();
$space = \App\Space::inRandomOrder()->first();
    return [
        "no_plate"=>$client->no_plate,
        "name"=>$client->name,
        "phone"=>$client->phone,
        "space_id"=>$space->id,
    ];
});
