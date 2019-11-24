<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionInvoice extends Model
{
    protected $table = "question_invoices";

    protected $fillable = [
    	'question_id',
    	'buyer_id',
    	'paypal_payer_id',
    	'price'
    ];
}
