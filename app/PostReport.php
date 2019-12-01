<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostReport extends Model
{
    protected $table = "post_reports";

    protected $fillable = [
        'reportType','reportDescription','post_id','report_by','reportStatus'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
