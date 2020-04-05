<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clients extends Model
{
     public function record(){
         return $this->hasMany('App\Record');
     }
     public function task(){
         return $this->hasMany('App\Task');
     }
}
