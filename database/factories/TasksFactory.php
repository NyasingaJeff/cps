<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;
$factory->define(Task::class, function (Faker $faker) {
    $client = App\clients::inRandomOrder()->first();
    return [
        "name"=>$client->name,
        "phone"=>$client->phone,
        "email"=>$client->email,
        "location" => $faker->randomElement(['Nakuru','Nairobi','Kisumu','Mombasa']),
        "destination"=>$client->no_plate,
        "no_plate"=>$client->no_plate,
        "status"=>$faker->randomElement([0,1]),
        "type"=>$faker->randomElement([0,1])
    ];
});
