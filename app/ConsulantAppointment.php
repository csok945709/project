<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\User;
class ConsulantAppointment extends Model
{

    protected $fillable = ['date','start_time', 'finish_time', 'comments', 'user_id', 'consultant_id', 'status'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
