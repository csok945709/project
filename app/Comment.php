<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reply;

class Comment extends Model
{

   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array(
        'name',
        'comment',
        'user_id',
        'post_id'
    );   
    /**
     * The belongs to Relationship
     *
     * @var array
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
    /**
     * The has Many Relationship
     *
     * @var array
     */

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }
}
