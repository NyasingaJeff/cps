<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{   
    protected $fillable=['no_plate',
    'name',
    'phone',
    'space_id'];
    //use SoftDeletes;
    public function space(){
       return $this->belongsTo('App\Space');
    }

    public function user(){
    return $this->belongsTo('App\User');
    }

    public function client(){
        return $this->belongsTo('App\clients','no_plate','no_plate' );
        }

}
