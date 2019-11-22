<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = "questions";

    protected $fillable = [
        'question_caption','question_content','question_type','reward', 'paid'
    ];
        
    public function user(){
        return $this->belongsTo(User::class);
    }

    
}
