<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
  protected $fillable = [
    'name','phone','email','user_id','country_code'
  ];
  // relationship constraints
  public function user()
    {
        return $this->belongsTo('App\User');
    }
  public function groups()
    {
        return $this->belongsToMany('App\Group');
    }
  public function messages()
      {
          return $this->belongsToMany('App\Message');
      }
}
