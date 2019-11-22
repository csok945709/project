<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    protected $table = "question_answers";

    protected $fillable = array(
        'name',
        'answer',
        'user_id',
        'question_id'
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

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
