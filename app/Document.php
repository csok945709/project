<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Document extends Model
{
    protected $table = "documents";

    protected $fillable = [
        'caption','description','document','price'
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(KnowledgeComment::class)->whereNull('document_id');
    }
}
