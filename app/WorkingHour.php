<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    protected $fillable = ['date', 'start_time', 'finish_time', 'consultant_id'];
}
