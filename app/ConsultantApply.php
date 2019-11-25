<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsultantApply extends Model
{
    protected $table = 'consultant_applies';
    protected $fillable = ['user_id','name', 'experience', 'workyears', 'status'];
}
