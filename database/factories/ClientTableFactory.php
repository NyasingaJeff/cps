<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\clients;
use Faker\Generator as Faker;



$factory->define(clients::class, function (Faker $faker) {
$a = $faker->randomElement(["K","GK"]);
switch ($a) {
    case "K":
        $b= $faker->randomLetter();
        $b=strtoupper($b);
        $c= $faker->randomLetter();
        $c=strtoupper($c);
        $plate= $a.$b.$c.$faker->numerify('###').$faker->randomLetter();
        $plate=strtoupper($plate);
        break;
    
    default:
        $plate=$a.$faker->numerify('###');
        break;
}
    return [
        "name"=>$faker->firstName,
        "phone"=>$faker->unique()->isbn10,
        "email"=>$faker->unique()->email,
        "no_plate"=>$plate
    ];
});
