<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clients extends Model
{   
    protected $guarded=[];
     public function record(){
         return $this->hasMany('App\Record','no_plate','no_plate');
     }
     public function task(){
         return $this->hasMany('App\Task');
     }
}
