<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
      'name','description','user_id'
    ];
    //
    public function user(){
      return $this->belongsTo('App\User');
    }
    public function contacts(){
      return $this->belongsToMany('App\Contact');
    }

}
