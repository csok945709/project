<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course_Category extends Model
{
    protected $table = 'course_category';
    protected $fillable = ['name', 'description'];

    public function course(){
        return $this->hasOne(Course::class);
    }
}
