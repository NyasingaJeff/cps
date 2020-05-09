<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    public function record(){
        return $this->hasMany('App\Record');
    }
    public  function reserve()
    {
        return $this->hasOne('App\Reserve');
    }
}
