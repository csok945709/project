<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $table = 'rewards';

    public $fillable = ['question_id', 'answer_id', 'reward_user','reward_by', 'reward'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
