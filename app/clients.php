<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clients extends Model
{   // T allow mass allocation to each field on the clients model
    protected $guarded=[];

    //The relationship between clients and mulltiple records the number plate field is the foreighn key
     public function record(){
         return $this->hasMany('App\Record','no_plate','no_plate');
     }

     //The relationship between a single client and multiple towing requests the number plate field is the foreighn keyalso on this case
     public function task(){
         return $this->hasMany('App\Task','no_plate','no_plate');
     }
}
