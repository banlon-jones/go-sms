<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
      'amount','mobile_account','transaction_id','message_id','user_id','channel','recipients'
    ];
    //defining relationships
    public function message(){
        return $this->belongsTo('App\Message');
    }
    public function users(){
        return $this->belongsTo('App\User');
    }

}
