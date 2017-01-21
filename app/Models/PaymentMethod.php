<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_methods';
    protected $primaryKey = 'payment_method_id';
    protected $guarded = [];
    public $timestamps = false;
    public $dates = [
    	'created_date', 'modified_date'
    ];
    protected $casts = [
    	'payment_method_active' => 'boolean',
    ];

    public function getPaymenMethodNameAttribute($value)
    {
    	return ucwords($value);
    }

    public function setPaymentMethodNameAttribute($value)
    {
    	$this->attributes['payment_method_name'] = ucwords($value);
    }
}
