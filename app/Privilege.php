<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    // defining database relationships
    public function roles(){
        return $this->belongsToMany('App\Role');
    }
}
