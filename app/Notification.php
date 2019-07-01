<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
      'subject','body'
    ];
    //defining relationships
    public function users()
    {
      return $this->belongsToMany('App\User');
    }
}
