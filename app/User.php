<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id', 'city', 'phone','status','profile','verification_doc',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //define database constraints


    public function role(){
        return $this->belongsTo('App\Role');
    }
    public function groups(){
      return $this->hasMany('App\Group');
    }
    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
    public function messages()
    {
        return $this->hasMany('App\Message');
    }
    public function notifications()
    {
        return $this->belongsToMany('App\Notification');
    }
    public function transactions(){
        return $this->hasMany('App\Transaction');
    }
}
