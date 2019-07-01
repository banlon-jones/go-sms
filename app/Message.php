<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
      'header','body','type','status','user_id'
    ];
    // defining Database relationship
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function contacts()
    {
      return $this->belongsToMany('App\Contact');
    }
    public function transactions(){
        return $this->hasMany('App\Transaction');
    }
}
