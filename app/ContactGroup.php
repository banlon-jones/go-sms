<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactGroup extends Model
{
  protected $fillable = [
    'Contact_id','group_id'
  ];
}
