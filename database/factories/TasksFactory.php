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
        "status"=>$faker->randomElement([0,1]),
        "destination"=> ("status"== 1) ? 'Impound' : randomElement(['Nakuru','Nairobi','Kisumu','Mombasa']),
        "no_plate"=>$client->no_plate,       
        "type"=>$faker->randomElement([0,1])
    ];
});
