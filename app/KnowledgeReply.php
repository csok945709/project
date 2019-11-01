<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KnowledgeReply extends Model
{
    protected $fillable = [
    	'knowledgecomment_id',
    	'name',
    	'reply',
    	'user_id'
    ];
}
