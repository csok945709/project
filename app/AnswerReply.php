<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerReply extends Model
{
    protected $fillable = [
    	'questionanswer_id',
    	'name',
    	'reply',
    	'user_id'
    ];
}
