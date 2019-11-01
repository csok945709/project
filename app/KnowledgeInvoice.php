<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KnowledgeInvoice extends Model
{
    protected $table = "knowledge_invoices";

    protected $fillable = [
    	'document_id',
    	'buyer_id',
    	'paypal_payer_id',
    	'price'
    ];
}
