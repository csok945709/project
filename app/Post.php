<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Like;
use App\Comment;
class Post extends Model
{
    // protected  $fillable = ['caption', 'image'];
    // protected  $guarded = [];

    protected $table = "posts";

    protected $fillable = [
        'caption','description','image','visit_count'
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function liked(){
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('post_id');
    }
}
