<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseReply extends Model
{
    protected $fillable = [
    	'coursecomment_id',
    	'name',
    	'reply',
    	'user_id'
    ];
}
