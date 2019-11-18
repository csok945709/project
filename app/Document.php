<?php

namespace App;

use willvincent\Rateable\Rateable;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = "documents";

    protected $fillable = [
        'caption','description','document','price'
    ];
    
    use Rateable;
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(KnowledgeComment::class)->whereNull('document_id');
    }

  
}
