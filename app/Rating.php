<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{

    protected $table = 'ratings';

    public $fillable = ['rating', 'rateable_id', 'user_id'];

    /**
     * @return mixed
     */
    public function rateable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    
}