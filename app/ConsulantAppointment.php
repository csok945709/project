<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\User;
class ConsulantAppointment extends Model
{

    protected $fillable = ['start_time', 'finish_time', 'comments', 'user_id', 'consultant_id'];

}
