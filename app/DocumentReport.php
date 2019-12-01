<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentReport extends Model
{
    protected $table = "document_reports";

    protected $fillable = [
        'reportType','reportDescription','document_id','report_by','reportStatus'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
