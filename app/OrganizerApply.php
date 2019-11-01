<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganizerApply extends Model
{
    protected $table = 'apply_form';
    protected $fillable = ['user_id','name', 'experience', 'workyears', 'status'];
}
