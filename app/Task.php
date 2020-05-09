<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function client(){
        return $this->belongsTo('App\clients','no_plate','no_plate');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
