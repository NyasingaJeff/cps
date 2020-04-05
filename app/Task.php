<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function client(){
        return $this->belongsTo('App\clients');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
