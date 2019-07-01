<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    //fillable fields
    protected $fillable = [
        'project_id', 'user_id'
    ];
}
