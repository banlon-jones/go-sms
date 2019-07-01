<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //fillable fields
    protected $fillable=[
        'name','description'
    ];
    // database relationship constraints
    public function users(){
        return $this->hasMany('App\User');
    }
    public function privileges(){
        return $this->belongsToMany('App\Privilege');
    }
}
