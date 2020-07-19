<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Space;
use Faker\Generator as Faker;
// use DB;

$factory->define(Space::class, function (Faker $faker) {
        $location = $faker->randomElement(['Nakuru','Nairobi','Kisumu','Mombasa']);
        $nakuru = ['Kenyatta','Maasai Market','Milimani','Muthurwa'];
        $nairobi=['Tom Mboya','Archives','Kangemi','Lawcorts'];
        $kisumu=['Otiero','Nyalenda','Polyview'];
        $mombasa=['Uknda','Ziwami','Matopeni'];
        switch ($location) {
            case 'Nakuru':
                $street = $faker->randomElement($nakuru);
                break;
            case 'Kisumu':
                $street = $faker->randomElement($kisumu);
                break;
            case 'Mombasa':
                $street = $faker->randomElement($mombasa);
                break;
            case 'Nairobi':
                    $street = $faker->randomElement($nairobi);
                    break;            
        }
        $a = str_split($location,2);
        $a= $a[0] ;
        $b = str_split($street,2);
        $b= $b[0] ;
        $st_id = $a.$b;
        $streets = DB::table('spaces')
                    ->where('location','=', $location)
                    ->where('street','=',$street)
                    ->get();
        $streetcount= count($streets);
        $x = $streetcount + 1 ;   
        $a= str_split($location,2);
        $a= $a[0];
        $b= str_split($street,2);
        $b = $b[0];
        if ($streetcount <= 9) {
            $st_id = $a.$b. '00'.$x; 
        } elseif ($streetcount <= 99) {
            $st_id = $a.$b.'0'.$x; 
        } else {
            $st_id = $a.$b.$x; 
        }   
    return [
        "location"=> $location,
        "street"=> $street,
        "st_id"=> $st_id,
        "price"=>$faker->numberBetween($min = 100, $max = 300 ),
        "status"=> 0,
        "category"=>$faker->randomElement($array=array('Car','Lorry','other'))
    ];
});
