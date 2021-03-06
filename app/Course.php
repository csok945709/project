<?php

namespace App;

use willvincent\Rateable\Rateable;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = ['title', 'description', 'image', 'price', 'category_id','language','venue','course_duration','time','date'];

    use Rateable;
    
    public function course_category()
    {
        return $this->belongsTo(Course_Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
