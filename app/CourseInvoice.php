<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseInvoice extends Model
{
    protected $table = "course_invoices";

    protected $fillable = [
    	'course_id',
    	'buyer_id',
    	'paypal_payer_id',
    	'price'
    ];
}
