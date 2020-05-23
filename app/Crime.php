<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crime extends Model
{
    public function offender(){
        return $this->hasMany('App\Offender');
    }
}
