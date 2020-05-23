<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offender extends Model
{
    public function crime(){
        return $this->belongsTo('App\Crime');
    }
}
