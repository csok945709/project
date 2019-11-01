<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\KnowledgeReply;
class KnowledgeComment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array(
        'name',
        'comment',
        'user_id',
        'document_id'
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

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function replies()
    {
        return $this->hasMany(KnowledgeReply::class);
    }
}
